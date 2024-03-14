<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABELLA PONTE PIATTI - ORDINI M / N
        Schema::table('dish_order', function (Blueprint $table) {
            $table->foreignId('dish_id')->constrained();
            $table->foreignId('order_id')->constrained();
        });

        //TABELLA PONTE RISTORANTI - TIPOLOGIE M / N
        Schema::table('restaurant_tipology', function (Blueprint $table) {
            $table->foreignId('restaurant_id')->constrained();
            $table->foreignId('tipology_id')->constrained();
        });

        //TABELLA ORDINI - RISTORANTI 1 / N
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('restaurant_id')->constrained();
        });

        //TABELLA RISTORANTI - PIATTI 1 / N
        Schema::table('dishes', function (Blueprint $table) {
            $table->foreignId('restaurant_id')->constrained();
        });

        //TABELLA RISTORANTI - USER 1 / 1
        Schema::table('restaurants', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //TABELLA PONTE PIATTI - ORDINI M / N
        Schema::table('dish_order', function (Blueprint $table) {

            $table->dropForeign('dish_order_dish_id_foreign');
            $table->dropColumn('dish_id');

            $table->dropForeign('dish_order_order_id_foreign');
            $table->dropColumn('order_id');
        });

        //TABELLA PONTE RISTORANTI - TIPOLOGIE M / N
        Schema::table('restaurant_tipology', function (Blueprint $table) {

            $table->dropForeign('restaurant_tipology_restaurant_id_foreign');
            $table->dropColumn('restaurant_id');

            $table->dropForeign('restaurant_tipology_tipology_id_foreign');
            $table->dropColumn('tipology_id');
        });

        //TABELLA ORDINI - RISTORANTI 1 / N
        Schema::table('orders', function (Blueprint $table) {

            $table->dropForeign('orders_restaurant_id_foreign');
            $table->dropColumn('restaurant_id');
        });

        //TABELLA RISTORANTI - PIATTI 1 / N
        Schema::table('dishes', function (Blueprint $table) {
            $table->dropForeign('dishes_restaurant_id_foreign');
            $table->dropColumn('restaurant_id');
        });

        //TABELLA RISTORANTI - USER 1 / 1
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign('restaurants_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
