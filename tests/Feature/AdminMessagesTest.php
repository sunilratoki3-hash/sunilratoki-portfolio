<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMessagesTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): Admin
    {
        return Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => 'test-password',
        ]);
    }

    public function test_authenticated_admin_can_view_contact_messages(): void
    {
        $admin = $this->createAdmin();

        ContactMessage::create([
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Website Inquiry',
            'message' => 'I would like to know more.',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.messages'));

        $response->assertOk();
        $response->assertSee('Website Inquiry');
        $response->assertSee('visitor@example.com');
    }

    public function test_admin_can_mark_a_message_as_read(): void
    {
        $admin = $this->createAdmin();

        $message = ContactMessage::create([
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Read Test',
            'message' => 'Test message.',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->from(route('admin.messages'))
            ->patch(route('admin.messages.read', $message));

        $response->assertRedirect(route('admin.messages'));

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'is_read' => true,
        ]);
    }

    public function test_admin_can_delete_a_contact_message(): void
    {
        $admin = $this->createAdmin();

        $message = ContactMessage::create([
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Delete Test',
            'message' => 'This message will be deleted.',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->delete(route('admin.messages.destroy', $message));

        $response->assertRedirect(route('admin.messages'));

        $this->assertDatabaseMissing('contact_messages', [
            'id' => $message->id,
        ]);
    }

    public function test_opening_an_unread_message_does_not_mark_it_as_read(): void
    {
        $admin = $this->createAdmin();

        $message = ContactMessage::create([
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Unread Test',
            'message' => 'This message should remain unread.',
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.messages.show', $message));

        $response->assertOk();
        $response->assertSee('Unread');
        $response->assertSee('Mark as Read');

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'is_read' => false,
        ]);
    }
    public function test_contact_message_content_is_escaped_in_admin_inbox(): void
    {
        $admin = $this->createAdmin();

        $payload = '<script>alert("XSS")</script>';

        ContactMessage::create([
            'name' => $payload,
            'email' => 'visitor@example.com',
            'subject' => $payload,
            'message' => $payload,
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->get(route('admin.messages'));

        $response->assertOk();
        $response->assertSee(e($payload), false);
        $response->assertDontSee($payload, false);
    }
}
