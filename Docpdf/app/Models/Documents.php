<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documents extends Model
{
    //
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'user_id',
        'document_type',
        'title',
        'contract_date',
        'client_name',
        'contractor_name',
        'start_date',
        'end_date',
        'amount',
        'business_content',
        'content',
    ];

    protected $casts = [
        'contract_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function ($document) {
            $document->uuid ??= (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
