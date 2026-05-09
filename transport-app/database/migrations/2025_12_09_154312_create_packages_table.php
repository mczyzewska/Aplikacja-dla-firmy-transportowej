<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::create('packages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained()->cascadeOnDelete(); 
        $table->foreignId('courier_id')->constrained()->cascadeOnDelete();
        $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
        // NOWE: Powiązanie z punktem odbioru
        $table->foreignId('pickup_point_id')->constrained()->cascadeOnDelete(); 
        
        $table->string('tracking_number')->unique();
        $table->decimal('weight', 8, 2)->default(0);
        $table->string('description')->nullable();
        $table->enum('status', ['odebrana', 'w_transporcie', 'w_punkcie', 'dostarczona']);
        $table->timestamps();
    });
}

    public function down(): void {
        Schema::dropIfExists('packages');
    }
};
