<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer("discount")->nullable()->after('price');
            $table->date("discount_date")->nullable()->after('discount');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->integer("discount")->nullable()->after('slug');
            $table->date("discount_date")->nullable()->after('discount');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->float("discount")->nullable()->after('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn("discount");
            $table->dropColumn("discount_date");
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn("discount");
            $table->dropColumn("discount_date");
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("discount");
        });
    }
}
