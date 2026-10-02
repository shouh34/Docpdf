<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'default_font',
        'default_font_size',
        'paper_size',
        'orientation',
        'auto_save',
        'default_document_type',
    ];


    protected $casts = [
        'auto_save' => 'boolean',
        'default_font_size' => 'integer',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
