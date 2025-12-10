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
        Schema::create('yacht_equipments', function (Blueprint $table) {
            $table->id();
            $table->integer("yacht_id");
            $table->integer("eq_id");
            $table->string("value", 100)->nullable(); 
            $table->timestamps();

            $table->foreign("yacht_id")->references("id")->on("yachts");
            $table->foreign("eq_id")->references("id")->on("equipment");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        chema::dropIfExists('yacht_equipments');
    }
};
