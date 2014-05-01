<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;
class JsonOutputCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'json:gettvguide';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		
		// $username = 'root';
		// $password = '';

		// try{
		// $conn = new PDO ('mysql:host=localhost;dbname=tvguide',$username, $password);
		// $query = "SELECT * FROM events";
		// $stmt = $conn->prepare($query);
		// $stmt ->execute();

		// $stagedevents = array();
		// while($result = $stmt->fetch(PDO::FETCH_ASSOC))
		// {
		// 	$stagedevents[] = $result;
		// }

		// $count = count($stagedevents);
		// $finalEvents = array();
		//$tvguide_channel=array("shows"=>);
		$argumentdate = str_replace('_', ' ',$this->option('date'));
		//$carboninputdate = Carbon::createFromFormat('Y-m-d H:i:s','2014-02-14 03:01:00');
		$carboninputdate = Carbon::createFromFormat('Y-m-d H:i:s',$argumentdate);
		$stagedevents = DB::table('events')->get();
      	$finalEvents = array();
      	$count = count($stagedevents);

		foreach ($stagedevents as $i => $event)
		{
			$nextelement = $i+1;
			$finalEvents[$i]['id'] = $stagedevents[$i]->id;
			if($i==$count-1)
			{
				$nextelement = $i;
				//echo 'time';
			}
			$carbon_start_date = Carbon::createFromFormat('d.m.Y H:i:s:00', $stagedevents[$i]->starting_time);
			$carbon_end_date = Carbon::createFromFormat('d.m.Y H:i:s:00', $stagedevents[$nextelement]->starting_time);
			// $finalEvents[$i]['isDisabled']='';
			// $finalEvents[$i]['isCurrent']='';

			if($carboninputdate >=$carbon_start_date && $carboninputdate<= $carbon_end_date)
			{
				$finalEvents[$i]['isCurrent']=true;
			}
			else
				$finalEvents[$i]['isDisabled']=true;
				
			
			
			$finalEvents[$i]['channel'] = $stagedevents[$i]->channel;
			$finalEvents[$i]['url'] = 'http://bringvictory.com/';

			//date calculations/data manipulations start here
			
			$finalEvents[$i]['starting_time'] = $carbon_start_date->format('d-m-Y H:i:s:00'); 
			$finalEvents[$i]['start'] = $carbon_start_date->format('H:i');
			
			
			$finalEvents[$i]['ending_time'] = $carbon_end_date->format('d-m-Y H:i:s:00'); 
			$finalEvents[$i]['end'] = $carbon_end_date->format('H:i');	
			$finalEvents[$i]['duration'] = date_diff($carbon_start_date, $carbon_end_date)->format('%h:%i');
			



			$finalEvents[$i]['width'] = ($carbon_start_date->diffInMinutes($carbon_end_date))*6;
			if($finalEvents[$i]['width']<90)
			{
				$finalEvents[$i]['isNarrow'] = true;
				//$finalEvents[$i]['width']=90;

			}
			$finalEvents[$i]['title'] = $stagedevents[$i]->title;
			$finalEvents[$i]['episode_title'] = $stagedevents[$i]->episode_title;
			$finalEvents[$i]['country'] = $stagedevents[$i]->country;
			$finalEvents[$i]['genre'] = $stagedevents[$i]->genre;
			$finalEvents[$i]['parental_rating'] = $stagedevents[$i]->parental_rating;
			$finalEvents[$i]['performer'] = $stagedevents[$i]->performer;
			$finalEvents[$i]['regie'] = $stagedevents[$i]->regie;
			$finalEvents[$i]['story_middle'] = $stagedevents[$i]->story_middle;
			$finalEvents[$i]['year'] = $stagedevents[$i]->year;
			//print_r($finalEvents[0]);
			//print_r($tvguide_channel);
		}


		// $conn=null;


		// }catch(PDOException $e){
		// 	echo 'ERROR: '.$e->getMessage();
		// }

		//noobtests

		//print_r($finalEvents[0]);
		echo json_encode($finalEvents, JSON_PRETTY_PRINT);
		// $fp = fopen('tvguide.json', 'w');
		// fwrite($fp, json_encode($finalEvents, JSON_PRETTY_PRINT));
		// fclose($fp);

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
			
	// 	
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
			array('date', null, InputOption::VALUE_REQUIRED, 'Y-m-d_H:i:s', null)
		);
	}

}
