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
        Schema::create('actualport', function (Blueprint $table) {
            $table->id();
            $table->integer("yachts_id");
            $table->integer("port_id");
            $table->timestamps();
 
            $table->foreign("yachts_id")->references("id")->on("yachts");
            $table->foreign("port_id")->references("id")->on("ports");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualport');
    }
};
