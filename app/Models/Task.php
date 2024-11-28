<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['dni', 'title', 'description', 'due_date', 'status'];

}
