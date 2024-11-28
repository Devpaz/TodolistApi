<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;


class TaskSeeder extends Seeder
{

    public function run(): void
    {
        Task::create([
            'dni' => '66667676',
            'title' => 'test',
            'description' => 'description',
            'due_date' => now(),
            'status' => 'pending',
        ]);

    }
}
