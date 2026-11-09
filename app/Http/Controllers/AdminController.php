<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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

        // Rate-limit key based on email and IP address
        $key = Str::lower($request->input('email')) . '|' . $request->ip();

        // Maximum 5 failed attempts within 60 seconds
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->with(
                'error',
                "Too many login attempts. Try again in {$seconds} seconds."
            );
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            RateLimiter::clear($key);

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        RateLimiter::hit($key, 60);

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
        $totalMessages = ContactMessage::count();

        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $totalProjects = Project::count();

        $publishedProjects = Project::where('is_published', true)->count();

        $draftProjects = Project::where('is_published', false)->count();

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

    // Display message without changing its read status
    public function showMessage(ContactMessage $message)
    {
        return view('admin.message-show', compact('message'));
    }

    // Explicitly mark a message as read
    public function markMessageRead(ContactMessage $message)
    {
        $message->is_read = true;
        $message->save();

        return back()->with('success', 'Message marked as read.');
    }

    public function destroyMessage(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages')
            ->with('success', 'Message deleted successfully!');
    }
}