<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ];
    public function casts(): array
    {
        return [
            'priority' => TaskPriorityEnum::class,
            'status' => TaskStatusEnum::class,
            'due_date' => 'date',
        ];
    }
}
