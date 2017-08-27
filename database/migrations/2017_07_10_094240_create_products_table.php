<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title');
			$table->string('handle')->nullable();
			$table->bigInteger('shop_id');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->dateTime('published_at')->nullable();
			$table->json('variants')->nullable();
			$table->json('images')->nullable();
			$table->json('image')->nullable();
			$table->json('tags')->nullable();
			$table->string('product_type')->nullable();
			$table->string('vendor')->nullable();
			$table->index('shop_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('products');
    }
}
