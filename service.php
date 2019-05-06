<?php

class Service
{
	/**
	 * Get a prize for women's day celebration
	 *
	 * @author salvipascual
	 * @param Request
	 * @param Response
	 */
	public function _main(Request $request, Response &$response)
	{
		// check if you are female
		$isFemale = $request->person->gender == "F";

		// check if you responded the survey
		$isSurvey = Connection::query("
			SELECT COUNT(*) AS count
			FROM _survey_answer_choosen 
			WHERE survey=28 and email='{$request->person->email}'")[0]->count >= 20;

		// send data to the view
		$response->setTemplate("main.ejs", ["isFemale"=>$isFemale, "isSurvey"=>$isSurvey]);
	}
}