<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // 既存テーブルにUUID列だけを追加
        Schema::table('documents', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();
        });

        // 既存レコードにもUUIDを設定
        DB::table('documents')
            ->whereNull('uuid')
            ->orderBy('id')
            ->get(['id'])
            ->each(function ($document) {
                DB::table('documents')
                    ->where('id', $document->id)
                    ->update(['uuid' => (string) Str::uuid()]);
            });

        // UUIDの重複を防止
        Schema::table('documents', function (Blueprint $table) {
            $table->unique('uuid');
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropUnique('documents_uuid_unique');
            $table->dropColumn('uuid');
        });
    }
};
