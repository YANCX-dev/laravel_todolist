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

    public function scopeNewTasks($query)
    {
        return $query->where('status_id', 1)->get();
    }

    public function scopeInProgressTasks($query)
    {
        return $query->where('status', 'in-progress')->get();
    }

    public function getCompletedTasks($query)
    {
        return $query->where('status', 'completed')->get();
    }




}
