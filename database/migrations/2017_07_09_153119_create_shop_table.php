<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::create('shops', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name');
				$table->string('email');
				$table->string('phone');
				$table->string('shop_owner');
				$table->string('domain');
				$table->string('myshopify_domain');
				$table->string('country');
				$table->string('city');
				$table->string('plan_name');
				$table->string('country_name')->nullable();
				$table->string('province')->nullable();
				$table->string('timezone')->nullable();
				$table->string('token')->nullable();
				$table->timestamps();
				$table->index('myshopify_domain');
				$table->index('id');
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('shops');
    }
}
