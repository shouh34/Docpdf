<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('friendships', function (Blueprint $table) {
            $table->id();

            // 友だち関係のペア。保存時は小さいユーザーIDを user_id、
            // 大きいユーザーIDを friend_id にする
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('friend_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // 申請を送ったユーザー
            $table->foreignId('requested_by')
                ->constrained('users')
                ->cascadeOnDelete();

            // pending: 申請中、accepted: 承認済み
            $table->string('status')->default('pending');

            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();

            // 同じペアの重複登録を防ぐ
            $table->unique(['user_id', 'friend_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('friendships');
    }
};
