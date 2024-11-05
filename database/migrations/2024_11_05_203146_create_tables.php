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
        // SITIOS DESDE DÓNDE SALEN LOS ENSERES
        Schema::create('almacenes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('lat');
            $table->string('lon');
            $table->timestamps();
        });

        Schema::create('almacen_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        // PUEBLOS - PAIPORTA... ETC
        Schema::create('sitios', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // SITIOS DONDE REPARTE
        Schema::create('almacen_sitio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('sitio_id');
            $table->timestamps();
            $table->foreign('almacen_id')->references('id')->on('almacenes');
            $table->foreign('sitio_id')->references('id')->on('sitios');
        });

        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('almacen_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('almacen_id');
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
        });

        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('almacen_id');
            $table->timestamps();
        });

        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('producto_id');
            $table->timestamps();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_producto');
        Schema::dropIfExists('almacen_producto');
        Schema::dropIfExists('almacen_sitio');
        Schema::dropIfExists('almacen_user');
        Schema::dropIfExists('sitios');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('almacenes');
        Schema::dropIfExists('pedidos');
    }
};
