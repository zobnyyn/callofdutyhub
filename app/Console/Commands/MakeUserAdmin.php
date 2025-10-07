<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    protected $signature = 'user:make-admin {email : Email пользователя}';
    protected $description = 'Назначить пользователя администратором';

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Пользователь с email {$email} не найден!");
            return 1;
        }

        if ($user->is_admin) {
            $this->info("Пользователь {$user->name} уже является администратором!");
            return 0;
        }

        $user->is_admin = true;
        $user->save();

        $this->info("Пользователь {$user->name} ({$user->email}) теперь администратор!");
        return 0;
    }
}

