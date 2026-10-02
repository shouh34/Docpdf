<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
     Schema::create('documents', function (Blueprint $table) {
    $table->id();

    // URLで使う推測されにくい識別子
    $table->uuid('uuid')->unique();

    // 所有ユーザー
    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('document_type');
    $table->string('title');
    $table->date('contract_date')->nullable();
    $table->string('client_name')->nullable();
    $table->string('contractor_name')->nullable();
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->decimal('amount', 15, 2)->nullable();
    $table->text('business_content')->nullable();
    $table->json('content')->nullable();

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
