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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai']);
            $table->unsignedBigInteger(('input_aspirasi_id'));
            $table->foreign('input_aspirasi_id')->references('id')->on('input_aspirasis')->onDelete('cascade');
            $table->text('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
    
};
