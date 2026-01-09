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
        Schema::create('clientcourses', function (Blueprint $table) {
            $table->id();
            $table->integer("client_id");
            $table->integer("course_id");
            $table->boolean("payment");
            $table->timestamps();

            $table->foreign("client_id")->references("id")->on("clients");
            $table->foreign("course_id")->references("id")->on("cruises");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientcourses');
    }
};
