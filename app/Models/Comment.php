<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Поля, которые могут быть заполнены через массовое присвоение
    protected $fillable = [
        'content',
        'task_id',
        'user_id',
    ];

    // Связь "Comment принадлежит Task"
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Связь "Comment принадлежит User"
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
