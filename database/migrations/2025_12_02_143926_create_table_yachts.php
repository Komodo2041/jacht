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
        Schema::create('yachts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nazwa jachtu
            $table->string('producer_id')->nullable(); 


            $table->string('model'); // Model (np. Bavaria 46)
            // Cechy podstawowe:
            $table->string('engine_brand')->nullable(); // Marka silnika (Yanmar, Volvo)
            $table->string('engine_model')->nullable(); // Model (4JH57)
            $table->integer('engine_power_hp')->default(0); // Moc w KM
            $table->integer('engine_count')->default(1); // Liczba silników (1-2)
            $table->string('propeller_type')->nullable(); // Typ śruby (fixed, folding)
            $table->integer('fuel_tank_liters')->default(200); // Pojemność paliwa
            $table->integer('water_tank_liters')->default(500); // Pojemność wody
            $table->integer('length_meters'); // Długość
            $table->integer('cabins'); // Kabiny
            $table->integer('berths'); // Koje
            $table->integer('build_year'); // Rok budowy 
            $table->timestamps();

            $table->foreign("producer_id")->references("id")->on("producer");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yachts');
    }
};
