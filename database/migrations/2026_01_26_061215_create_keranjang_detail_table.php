<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keranjang_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keranjang_id')->constrained('keranjang')->cascadeOnUpdate()  
                                                                        ->cascadeOnDelete();
            $table->string('kode_item');
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_detail');
    }
};
