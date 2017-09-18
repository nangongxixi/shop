<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->comment('分类ID');
            $table->string('name')->comment('名称');
            $table->string("coverPic")->comment("封面图");
            $table->string('description')->comment('描述');
            $table->string('content')->default(1)->comment('内容');
            $table->integer('status')->default(1)->comment('状态 1.显示 2.不显示');
            $table->integer('sort')->default(1000)->comment('排序');

            $table->index(['category_id', 'status']);//关联索引

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
        Schema::dropIfExists('news');
    }
}
