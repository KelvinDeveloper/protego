<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePortfolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_portfolios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('status');
            $table->string('title');
            $table->string('pic')->nullable();
            $table->text('description')->nullable();
            $table->string('href')->nullable();
            $table->integer('website_id');
            $table->integer('work_group_id');

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
        Schema::dropIfExists('website_portfolios');
    }
}
