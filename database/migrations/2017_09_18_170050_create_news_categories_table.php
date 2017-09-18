<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_category', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->comment('名称：1.公司新闻 2.行业新闻');
            $table->string("coverPic")->comment("封面图");
            $table->string('sort')->comment('排序');
            $table->integer('status')->comment('状态：1.显示 2.不显示');
            $table->string('description')->comment('描述');

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
        Schema::dropIfExists('news_category');
    }
}
