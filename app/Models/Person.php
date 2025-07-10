<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';


    protected $fillable = ['name', 'avatar'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
