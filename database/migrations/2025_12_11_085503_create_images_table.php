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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->integer('album_id');  
            $table->string('title');           
            $table->text('description')->nullable();     
            $table->string('filename');                     
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->timestamps();
            $table->foreign("album_id")->references("id")->on("albums");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
