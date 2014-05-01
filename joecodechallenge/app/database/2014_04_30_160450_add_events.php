<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		    $channels = $event->getElementsByTagName("channel");
			$starting_times = $event->getElementsByTagName("starting_time");
			$titles = $event->getElementsByTagName("title");
			$episode_titles = $event->getElementsByTagName("episode_title");
			$countries = $event->getElementsByTagName("country");
			$genres = $event->getElementsByTagName("genre");
			$parental_ratings =  $event->getElementsByTagName("parental_rating");
			$performers =  $event->getElementsByTagName("performer");
			$regies =  $event->getElementsByTagName("regie");
			$stories_middle =  $event->getElementsByTagName("story_middle");
			$years =  $event->getElementsByTagName("year");


			$channel = trim($channels->item(0)->nodeValue);
			$starting_time = $starting_times->item(0)->nodeValue;
			$title = trim($titles->item(0)->nodeValue);
			$episode_title = trim($episode_titles->item(0)->nodeValue);
			$country = trim($countries->item(0)->nodeValue);
			$genre = trim($genres->item(0)->nodeValue);
			$parental_rating = trim($parental_ratings->item(0)->nodeValue);
			$performer = trim($performers->item(0)->nodeValue);
			$regie = trim($regies->item(0)->nodeValue);
			$story_middle = trim($stories_middle->item(0)->nodeValue);
			$year = trim($years->item(0)->nodeValue);

			DB::table('events')->insert(array(
			'channel'=>$channel,
			'starting_time'=>date("d-m-Y H:m:s:ss", strtotime($starting_time)),
			'title'=>$title,
			'episode_title'=>$episode_title,
			'country'=>$country,
			'genre'=>$genre,
			'parental_rating'=>$parental_rating,
			'performer'=>$performer,
			'regie'=>$regie,
			'story_middle'=>$story_middle,
			'year'=>$year,
			'created_at'=>date('Y-m-d H:m:s'),
			'created_at'=>date('Y-m-d H:m:s')
			));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('events')->delete();
	}

}
