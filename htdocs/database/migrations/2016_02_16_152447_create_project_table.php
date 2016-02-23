<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up() {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
            $table->string('summary');
            $table->string('detail')->unique();
			$table->string('category');
			$table->double('amount_funding');
            $table->integer('funding_duration');
			$table->string('reward');
            $table->date('time');
			$table->string('status');
			$table->string('image');
			$table->string('video');
			$table->string('home');
			$table->string('update');
			$table->integer('user_id');
			$table->integer('featured');
			$table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('project');
    }
}
