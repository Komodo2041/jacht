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
        Schema::create('table_types', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->string("feature", 200);
            $table->string("number_of_people", 200);
            $table->string("routes", 200);
            $table->string("organization_costs", 200);
            $table->string("requirements", 200);
            $table->text("body");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_types');
    }
};
