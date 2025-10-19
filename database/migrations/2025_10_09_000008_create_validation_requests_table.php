<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('validation_requests', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained()->cascadeOnDelete();
            $t->foreignId('submitted_by')->nullable() // ← tambahkan nullable()
            ->constrained('users')
            ->nullOnDelete();
            $t->foreignId('assigned_admin')->nullable()
            ->constrained('users')
            ->nullOnDelete();
            $t->enum('status',['submitted','approved','rejected'])->default('submitted');
            $t->text('notes')->nullable();
            $t->timestamp('submitted_at')->nullable();
            $t->timestamp('reviewed_at')->nullable();
            $t->timestamps();
        });

    }
    public function down(): void { Schema::dropIfExists('validation_requests'); }
};
