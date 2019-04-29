<?php


class Service
{
	/**
	 * Get a prize for women's day celebration
	 *
	 * @author alexmasters1
	 * @param Request
	 * @param Response
	 */
	public function _main(Request $request, Response &$response)
	{
        // get the the gender
        if ($request->person->gender == "M")
        return $response->setTemplate('message.ejs', [
            "header" => "Este es un servicio especial para mujeres",
            "icon"   => "sentiment_satisfied",
            "text"   => "Hay muchos otros servicios que puedes disfrutar",
        ]);

        // get the survey details
		$checkSurvey = Connection::query("
        SELECT 
            COUNT(*) AS count
        FROM _survey_answer_choosen 
        WHERE survey=28 and email='{$request->person->email}'
        ");
        
        if ($checkSurvey[0]->count < 20) {
            $checkSurvey = false;
        } else {
            $checkSurvey = true;
        }

        // select images
        $pathToService = Utils::getPathToService($response->serviceName);
        $img = "$pathToService/images/premios.jpg";
        $img2 = "$pathToService/images/simcard1.png";
        $img3 = "$pathToService/images/recarga.png";

        // create a json object to send to the template
        $responseContent = array(
            "checkSurvey"=> $checkSurvey,
            "img"        => $img,
            "img2"       => $img2,
            "img3"       => $img3
        );
        
        // get the images to send to the template
        $images = array( 
            $responseContent['img'],
            $responseContent['img2'],
            $responseContent['img3']
        );

        // send data to the view
		$response->setLayout("oracion.ejs");
		$response->setTemplate("main.ejs", $responseContent, $images);
		
        }
    }

