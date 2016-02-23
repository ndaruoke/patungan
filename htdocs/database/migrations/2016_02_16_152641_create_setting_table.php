<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up() {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
			$table->string('site_url');
            $table->string('maintenance_type');
            $table->string('about');
			$table->string('contact_us');
			$table->string('faq');
            $table->string('policy');
			$table->string('term_of_use');
            $table->string('facebook');
			$table->string('linkedin');
			$table->string('twitter');
			$table->string('youtube');
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
        Schema::drop('setting');
    }
}
