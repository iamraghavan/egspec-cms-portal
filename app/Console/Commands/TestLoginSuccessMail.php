<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\LoginSuccessMail;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;
use App\Models\User;

class TestLoginSuccessMail extends Command
{
    protected $signature = 'test:loginsuccessmail';
    protected $description = 'Send a test Login Success email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Retrieve a test user (or create a dummy user)
        $user = User::first(); // Replace with an actual user ID if necessary

        if (!$user) {
            $this->error('No user found in the database.');
            return;
        }

        // Generate login details
        $agent = new Agent();
        $loginDetails = [
            'date' => now()->format('F j, Y, g:i A (T)'),
            'os' => $agent->platform(),
            'browser' => $agent->browser(),
            'location' => request()->ip() ?? '127.0.0.1', // Default to localhost for testing
        ];

        // Send the email
        Mail::to($user->email)->send(new LoginSuccessMail($user, $loginDetails));

        $this->info('Test Login Success email sent to ' . $user->email);
    }
}