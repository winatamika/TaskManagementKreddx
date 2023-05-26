<?php

use Illuminate\Database\Seeder;
use App\Tasks;
use App\User;


class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first(); // Assuming you have at least one user record

        Tasks::create([
            'title' => 'Task 1',
            'description' => 'Description for Task 1',
            'priority' => 'high',
            'status' => 'in-progress',
            'due_date' => '2023-08-21',
            'task_owner' => $user->id,
        ]);

        Tasks::create([
            'title' => 'Task 2',
            'description' => 'Description for Task 2',
            'priority' => 'medium',
            'status' => 'pending',
            'due_date' => '2023-08-22',
            'task_owner' => $user->id,
        ]);
    }
}
