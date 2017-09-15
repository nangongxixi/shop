<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("order_id")->comment("订单ID");

            $table->integer("product_id")->comment("产品ID");
            $table->string("product_full_name")->comment("产品名称");//颜色尺码等信息
            $table->integer("quantity")->comment('数量');
            $table->decimal('price')->comment('单价');

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
        Schema::dropIfExists('order_detail');
    }
}
