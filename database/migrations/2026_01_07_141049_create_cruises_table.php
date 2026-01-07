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
        Schema::create('cruises', function (Blueprint $table) {
            $table->id();
            $table->integer("yacht_id");
            $table->date("date_from");
            $table->date("date_to");
            $table->integer("port_start_id");
            $table->date("port_end_id");
            $table->timestamps();

            $table->foreign("yacht_id")->references("id")->on("yachts");
            $table->foreign("port_start_id")->references("id")->on("ports");
            $table->foreign("port_end_id")->references("id")->on("ports");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cruises');
    }
};
