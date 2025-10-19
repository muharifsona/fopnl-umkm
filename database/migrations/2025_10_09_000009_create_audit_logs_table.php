<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('audit_logs', function (Blueprint $t) {
            $t->id();
            $t->string('entity');      // e.g., 'Product'
            $t->unsignedBigInteger('entity_id')->nullable();
            $t->string('action');      // e.g., 'created','updated','generated_label'
            $t->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();
            $t->longText('details')->nullable();
            $t->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void { Schema::dropIfExists('audit_logs'); }
};
