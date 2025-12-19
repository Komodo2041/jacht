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
        Schema::create('yachtcrew', function (Blueprint $table) {
            $table->id();
            $table->integer("yacht_id");
            $table->integer("crew_id");
            $table->timestamps();

            $table->foreign("yacht_id")->references("id")->on("yachts");
            $table->foreign("crew_id")->references("id")->on("crew");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yachtcrew');
    }
};
