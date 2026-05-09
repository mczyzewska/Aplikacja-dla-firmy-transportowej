<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
{
    Schema::create('package_statuses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('package_id')->constrained()->cascadeOnDelete();
        // Tutaj musisz dodać te same statusy co w tabeli packages
        $table->enum('status', ['odebrana', 'w_transporcie', 'w_punkcie', 'dostarczona']);
        $table->timestamp('changed_at');
        $table->timestamps();
    });
}

    public function down(): void {
        Schema::dropIfExists('package_statuses');
    }
};
