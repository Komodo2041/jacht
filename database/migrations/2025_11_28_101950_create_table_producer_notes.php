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
        Schema::create('producer_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("producer_id");
            $table->text("body");
            $table->timestamps();

            $table->foreign("producer_id")->references("id")->on("producer");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producer_notes');
    }
};
