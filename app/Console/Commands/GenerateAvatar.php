<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravolt\Avatar\Facade as Avatar;
use App\Models\User;

class GenerateAvatar extends Command
{
    protected $signature = 'user:generate-avatar {email}';
    protected $description = 'Generate an avatar for the specified user email and save it in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        // Generate the avatar as a Base64 image
        $avatar = Avatar::create($user->name)->toBase64();

        // Save the avatar in the user's profile
        $user->avatar = $avatar;
        $user->save();

        $this->info("Avatar generated and saved for user: {$user->name} ({$email})");

        return 0;
    }
}