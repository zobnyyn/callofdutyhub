<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListAdmins extends Command
{
    protected $signature = 'user:list-admins';
    protected $description = 'Показать список всех администраторов';

    public function handle()
    {
        $admins = User::where('is_admin', true)->get();

        if ($admins->isEmpty()) {
            $this->info('Администраторов не найдено!');
            return 0;
        }

        $this->info('Список администраторов:');
        $this->newLine();

        $data = [];
        foreach ($admins as $admin) {
            $data[] = [
                'ID' => $admin->id,
                'Имя' => $admin->name,
                'Email' => $admin->email,
                'Дата регистрации' => $admin->created_at->format('d.m.Y H:i'),
            ];
        }

        $this->table(['ID', 'Имя', 'Email', 'Дата регистрации'], $data);

        return 0;
    }
}

