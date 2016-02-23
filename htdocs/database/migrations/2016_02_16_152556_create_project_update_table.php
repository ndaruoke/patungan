<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('project_update', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('project_id')->unique();
            $table->integer('user_id_comment');
            $table->string('title_comment');
			$table->string('content_comment');
			$table->date('created_date');
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
        Schema::drop('project_update');
    }
}
