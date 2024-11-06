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
        Schema::create('voluntarios', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->timestamps();
        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('voluntario_id')->nullable();
            $table->foreign('voluntario_id')->references('id')->on('voluntarios');
            $table->string('hora_estimada_recogida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign('pedidos_voluntario_id_foreign');
            $table->dropColumn('voluntario_id');
            $table->dropColumn('hora_estimada_recogida');
        });
        Schema::dropIfExists('voluntarios');
    }
};
