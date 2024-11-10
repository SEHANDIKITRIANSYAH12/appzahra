<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tractor_id')->constrained()->onDelete('cascade'); // Relasi ke tabel tractors
            $table->decimal('maintenance_cost', 15, 2); // Biaya perawatan
            $table->decimal('operator_salary', 15, 2); // Gaji operator
            $table->decimal('fuel_cost', 15, 2); // Biaya bahan bakar
            $table->decimal('hectar_area', 15, 2); // Luas lahan (hektar)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costs');
    }
}

