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
        Schema::create('crew', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email', 100);
            $table->string('passport_number', 100);
            $table->text("notes");
            $table->date("birthday");
            $table->integer("country_id");
            $table->integer("job_id");
            $table->timestamps();
            $table->enum("status", ["pracuje", "zwolniony", "już nie pracuje", "okres próbny"]);

            $table->foreign("job_id")->references("id")->on("jobs");
            $table->foreign("country_id")->references("id")->on("nationality");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew');
    }
};
