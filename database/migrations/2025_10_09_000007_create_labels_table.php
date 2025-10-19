<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('labels', function (Blueprint $t) {
            $t->id();
            $t->foreignId('product_id')->constrained()->cascadeOnDelete();
            $t->enum('label_type',['TrafficLight','NutriScore','QR'])->nullable();
            $t->string('label_image_path')->nullable();
            $t->string('qr_code_value')->nullable();
            $t->timestamp('generated_at')->nullable();
            $t->unsignedInteger('version')->default(1);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('labels'); }
};
