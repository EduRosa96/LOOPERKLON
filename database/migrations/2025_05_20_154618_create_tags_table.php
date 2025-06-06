<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('loop_tag', function (Blueprint $table) {
            $table->foreignId('loop_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->primary(['loop_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loop_tag');
        Schema::dropIfExists('tags');
    }
};
