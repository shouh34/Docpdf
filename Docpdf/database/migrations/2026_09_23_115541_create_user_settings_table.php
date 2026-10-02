<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();

            // ユーザーID
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // エディタ設定
            $table->string('default_font')
                ->default('Noto Sans JP');

            $table->unsignedInteger('default_font_size')
                ->default(16);

            // 用紙サイズ
            $table->string('paper_size')
                ->default('A4');

            // 縦・横
            $table->string('orientation')
                ->default('portrait');

            // 自動保存
            $table->boolean('auto_save')
                ->default(true);

            // デフォルト文書タイプ
            $table->string('default_document_type')
                ->default('contract');

            $table->timestamps();

            // 1ユーザーにつき設定は1件
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
