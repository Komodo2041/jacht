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
        Schema::create('jobs_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("dept_id");
            $table->string("name", 100);
            $table->timestamps();

            $table->foreign("dept_id")->references("id")->on("departments");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_positions');
    }
};
