<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['title', 'description', 'priority', 'status', 'due_date', 'task_owner'];

}
