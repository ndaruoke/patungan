<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRewardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('project_reward', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('project_id');
			$table->string('reward_1');
            $table->string('reward_2');
            $table->string('reward_3');
			$table->string('reward_4');
			$table->string('reward_5');
			$table->string('count_1');
            $table->string('count_2');
            $table->string('count_3');
			$table->string('count_4');
			$table->string('count_5');
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
        Schema::drop('project_reward');
    }
}
