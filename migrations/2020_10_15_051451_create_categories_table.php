<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 64)->comment('分类名');
            $table->string('type', 64)->comment('类型');
            $table->unsignedBigInteger('parent_id')->comment('父级id');
            $table->string('path', 256)->comment('路径');
            $table->string('path_id', 256)->comment('路径id');
            $table->float('weight')->comment('权重');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
}
