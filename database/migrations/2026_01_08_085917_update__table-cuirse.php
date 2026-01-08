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
        Schema::table('cruises', function (Blueprint $table) {
            $table->string("name");
            $table->text("body");
            $table->enum("status", ["planed", "starded", "ended"])->default("planed");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cruises', function (Blueprint $table) {
             $table->dropColumn("name");
             $table->dropColumn("body");
             $table->dropColumn("status");
        });
    }
};
