<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        // Message statistics
        $totalMessages = ContactMessage::count();

        $unreadMessages = ContactMessage::where('is_read', false)->count();

        // Project statistics
        $totalProjects = Project::count();

        $publishedProjects = Project::where('is_published', true)->count();

        $draftProjects = Project::where('is_published', false)->count();

        // Latest 5 messages
        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMessages',
            'unreadMessages',
            'totalProjects',
            'publishedProjects',
            'draftProjects',
            'recentMessages'
        ));
    }

    // Display all contact messages
    public function messages(Request $request)
    {
        $filters = $request->validate([
            'search' => 'nullable|string|max:100',
            'status' => 'nullable|in:all,unread,read',
        ]);

        $search = $filters['search'] ?? '';
        $status = $filters['status'] ?? 'all';

        $query = ContactMessage::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($status === 'unread') {
            $query->where('is_read', false);
        } elseif ($status === 'read') {
            $query->where('is_read', true);
        }

        $messages = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.messages', compact(
            'messages',
            'search',
            'status'
        ));
    }

    // Display one message
    public function showMessage(ContactMessage $message)
    {
        // Automatically mark as read when opened
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.message-show', compact('message'));
    }

    // Mark message as read
    public function markMessageRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);

        return back()->with('success', 'Message marked as read.');
    }

    // Delete a message
    public function destroyMessage(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages')
            ->with('success', 'Message deleted successfully.');
    }
}

