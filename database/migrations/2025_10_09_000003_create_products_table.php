<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->text('description')->nullable();
            $t->decimal('net_weight', 10, 2)->nullable();
            $t->string('serving_size')->nullable();
            $t->enum('status', ['draft','pending','validated'])->default('draft');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
