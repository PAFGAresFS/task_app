<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];

    public function people()
    {
        return $this->belongsToMany(Person::class, 'person_task', 'task_id', 'person_id');
    }
}
