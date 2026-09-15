<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Override;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'is_current',
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