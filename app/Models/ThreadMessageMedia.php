<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreadMessageMedia extends Model
{
    use HasUuids;

    protected $fillable = [
        'thread_message_id',
        'file_path',
        'file_type',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(ThreadMessage::class);
    }
}
