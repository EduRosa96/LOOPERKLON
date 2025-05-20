<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('loops', function (Blueprint $table) {
            $table->id(); // id autoincremental
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('filename'); // nombre del archivo MP3/WAV
            $table->integer('bpm')->nullable();
            $table->string('key_signature', 10)->nullable();
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loops');
    }
};
