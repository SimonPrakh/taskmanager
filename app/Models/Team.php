<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    // Поля, которые могут быть заполнены через массовое присвоение
    protected $fillable = [
        'name',
    ];

    // Связь "Team имеет много Users"
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Связь "Team имеет много Tasks"
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
