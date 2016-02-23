<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
			$table->string('amount');
            $table->date('time');
            $table->string('reward_status');
			$table->string('donation_status');
			$table->string('bank_account');
            $table->integer('user_id');
			$table->integer('project_id');
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
        Schema::drop('donations');
    }
}
