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
        Schema::create('yachts_parameters', function (Blueprint $table) {
            $table->id();
            $table->integer("yacht_id");
            $table->integer("parametr_id");
            $table->string("value", 100); 
            $table->timestamps();

            $table->foreign("yacht_id")->references("id")->on("yachts");
            $table->foreign("parametr_id")->references("id")->on("parametrs");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           Schema::dropIfExists('yachts_parameters');
    }
};
