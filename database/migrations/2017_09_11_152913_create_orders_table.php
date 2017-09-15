<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("member_id")->comment('下单会员ID');
            $table->string("name")->comment('订单名称');
            $table->integer("pay_type")->comment('支付类型 1在线支付 2货到付款');
            $table->decimal('total_fee')->comment('订单总金额');

            $table->integer("status")->default(1)->comment('订单状态 1新订单 2 进行中 3交易成功 4无效订单');
            $table->integer("payment_status")->default(1)->comment('支付状态 1未支付 2已支付');
            $table->integer("delivery_status")->default(1)->comment('物流状态 1未发货 2已发货 3已签收');

            $table->string('receiver_name')->comment('收货人');
            $table->integer("receiver_province")->comment('省');
            $table->integer("receiver_city")->comment('市');
            $table->integer("receiver_district")->comment('区');
            $table->string("receiver_detail")->comment('详细地址');
            $table->string("receiver_phone")->comment('手机');
            $table->string("receiver_email")->default('')->comment('电子邮箱');

            $table->timestamps();

            $table->index(['member_id','created_at']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
