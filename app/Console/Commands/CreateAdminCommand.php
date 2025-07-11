<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->ask('What is the admin name?');
        $email = $this->ask('What is the admin email?');
        $password = $this->ask('What is the admin password?');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'role' => 'admin',
            'account_verified_at' => now(),
            'password' => Hash::make($password),
            'otp' => rand(100000, 999999)
        ]);

        if (!$user->save()) {
            $this->error('Failed to save admin user');
            return;
        }

        $this->info('Admin ' . $name . ' created successfully with email ' . $email);
        $this->info('Admin ' . $name . ' created successfully');
    }
}
