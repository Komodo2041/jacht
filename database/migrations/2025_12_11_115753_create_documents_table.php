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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->morphs('documentable');   

            $table->string('title');  
            $table->string('type_id');
            $table->string('filename');  
            $table->string('path');
            
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
   
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('file_size')->nullable();
            $table->string('mime_type')->nullable();

            $table->timestamps();

            $table->foreign("type_id")->references("id")->on("documents_types");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
