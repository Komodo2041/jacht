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
        Schema::create('confpos', function (Blueprint $table) {
            $table->id();
            $table->integer("yacht_id");
            $table->integer("job_id");
            $table->integer("value");
            $table->timestamps();

            $table->foreign("yacht_id")->references("id")->on("yachts");
            $table->foreign("job_id")->references("id")->on("jobs");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confpos');
    }
};
