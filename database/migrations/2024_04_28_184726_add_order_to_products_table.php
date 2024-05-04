<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddOrderToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Agregar la columna de orden
            Schema::table('products', function ($table) {
                $table->integer('order')->nullable()->after('status');
            });

            // Asignar un número de orden único a cada producto
            DB::statement('SET @order = 0;');
            DB::statement('UPDATE products SET `order` = (@order := @order + 1);');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function ($table) {
            $table->dropColumn('order');
        });
    }
}
