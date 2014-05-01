<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvguide extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tvguide', function($t){
			$t->increments('id');
			$t->boolean('isDisabled');
			$t->string('channel');
			$t->string('url');
			$t->datetime('starting_time');
			$t->time('start');
			$t->time('end');
			$t->time('duration');
			$t->string('width');
			$t->string('title');
			$t->string('episode_title');
			$t->string('country');
			$t->string('genre');
			$t->string('parental_rating');
			$t->string('performer');
			$t->string('regie');
			$t->text('story_middle');
			$t->string('year');
			$t->timestamps();
			});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tvguide');
	}

}
