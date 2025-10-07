<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RemoveUserAdmin extends Command
{
    protected $signature = 'user:remove-admin {email : Email пользователя}';
    protected $description = 'Снять права администратора с пользователя';

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Пользователь с email {$email} не найден!");
            return 1;
        }

        if (!$user->is_admin) {
            $this->info("Пользователь {$user->name} не является администратором!");
            return 0;
        }

        $user->is_admin = false;
        $user->save();

        $this->info("Права администратора сняты с пользователя {$user->name} ({$user->email})!");
        return 0;
    }
}

