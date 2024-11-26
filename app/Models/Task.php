<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'status_id',
        'name',
        'text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status():BelongsTo
    {
        return $this->BelongsTo(Status::class);
    }

    public function scopeToDoTask($query)
    {
        return $query->where('status_id', 1)->get();
    }

    public function scopeInProgressTasks($query)
    {
        return $query->where('status', 2)->get();
    }

    public function scopeCompletedTasks($query)
    {
        return $query->where('status', 3)->get();
    }




}
