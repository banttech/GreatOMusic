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
        Schema::create('music_titles', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('title',255);
            $table->integer('artist_id');
            $table->integer('first_genre_id');
            $table->integer('second_genre_id');
            $table->integer('third_genre_id');
            $table->integer('tempo_id');
            $table->integer('version_id');
            $table->string('mp3',255);
            $table->string('wav',255);
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_titles');
    }
};
