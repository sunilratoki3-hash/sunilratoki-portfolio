<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_contact_form_submission_is_saved(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'phone' => '9800000000',
            'address' => 'Kathmandu',
            'subject' => 'Portfolio Inquiry',
            'message' => 'I would like to discuss your project.',
        ]);

        $response->assertRedirect(route('contact'));

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Portfolio Inquiry',
        ]);
    }

    public function test_contact_form_rejects_invalid_email(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test Visitor',
            'email' => 'invalid-email',
            'subject' => 'Portfolio Inquiry',
            'message' => 'Test message.',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertDatabaseCount('contact_messages', 0);
    }
public function test_contact_form_is_rate_limited_after_three_successful_submissions(): void
{
    $data = [
        'name' => 'Test Visitor',
        'email' => 'visitor@example.com',
        'phone' => '9800000000',
        'subject' => 'Portfolio Inquiry',
        'message' => 'Test contact message.',
    ];

    for ($attempt = 1; $attempt <= 3; $attempt++) {
        $this->post('/contact', $data)
            ->assertRedirect(route('contact'));
    }

    $response = $this->post('/contact', $data);

    $response->assertSessionHas('error', function ($message) {
        return str_starts_with($message, 'Too many messages.');
    });

    $this->assertDatabaseCount('contact_messages', 3);
}
}