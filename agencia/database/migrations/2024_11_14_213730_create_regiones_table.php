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
        Schema::create('regiones', function (Blueprint $table) {
            //$table->id();
            /*crea una columna int primary key llamado id*/
            $table->tinyIncrements('idRegion');
            $table->string('nombre', 45)->unique(); //('nombre, length)
            //$table->timestamps();
            /*crea 2 columnas de tipo TImestamp, updated_at y created_at*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regiones');
    }
};
