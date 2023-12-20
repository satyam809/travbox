<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";

########################## LIVE CREDENTIAL ############################
	$key = "RgpGKArT74kxW1Zt0agilUlZLvdiXY"; 
	$secret = "DZ70VaZKYqFx1BTiz6wW4IbCjt5lSD";
	$base_url = "http://api.seatseller.travel/";

########################## LIVE CREDENTIAL ############################
########################## TEST CREDENTIAL ############################
   /* $key = "MCycaVxF6XVV0ImKgqFPBAncx0prPp"; //MCycaVxF6XVV0ImKcqFPBAncx0prPp
	$secret = "5f0lpy9heMvXNQ069lQPNMomysX6rt"; //5f0lpcheMvXNc069lQPNMomysX6rt
	$base_url = "http://api.seatseller.travel/";*/
	
########################## TEST CREDENTIAL ############################

	function invokeGetRequest($requestUrl)
	{
		global $key, $secret, $base_url,$source,$destination,$doj,$tripId;
		$url = $base_url.$requestUrl;
		$curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, CURLOPT_CONNECTTIMEOUT => 0);
		$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
		OAuthStore::instance("2Leg", $options);
		$method = "GET";
		$params = null;
		try
		{
			$request = new OAuthRequester($url, $method, $params);
			$result = $request->doRequest();
			$response = $result['body'];
			return $response;
		}
		catch(OAuthException2 $e)
		{
			echo "Exception happened".$e."<hr></br>";
		}
		catch(Exception $e1)
		{
			echo "generic exception".$e1."<hr></br>";
		}
	}

	function invokePostRequest($requestUrl, $blockRequest)
	{		
		$key2="RgpGKArT74kxW1Zt0agilUlZLvdiXY";
		global $key, $secret, $base_url;
		$url = $base_url.$requestUrl;
		$curl_options = array(CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_TIMEOUT => 0, CURLOPT_CONNECTTIMEOUT => 0);
		$options = array('consumer_key' => $key2, 'consumer_secret' => $secret);
		OAuthStore::instance("2Leg", $options);
		$method = "POST";
		$params = null;
		try
		{

			$request = new OAuthRequester($url, $method, $params, $blockRequest);
			//echo "Timeout is: ".$curl_options[CURLOPT_TIMEOUT]."<hr></br>";
			//echo "Connection timeout is: ".$curl_options[CURLOPT_CONNECTTIMEOUT ]."<hr></br>";
			//echo "body: ".$blockRequest."<hr></br>";
			$result = $request->doRequest(0,$curl_options);
			
			$response = $result['body'];
			return $response;
		}
/*		catch(OAuthException2 $e)
		{
			return 0;
		}*/
		catch(Exception $e1)
		{
		    echo $url;
			echo "<br>";
			echo $blockRequest;
			echo "<br>";
			echo "generic exception".$e1->getMessage()."<hr></br>";
		}
	}

	function getAllSources()
	{
		return invokeGetRequest("sources");
	}
	
	function getDestinationForSource($sourceId)
	{
		return invokeGetRequest("destinations?source=".$sourceId);
	}

	function getAvailableTrips($sourceId,$destinationId,$date)
	{
		return invokeGetRequest("availabletrips?source=".$sourceId. "&destination=" . $destinationId . "&doj=" . $date); 		
	}
	 
	function getBoardingPointDetails($boarding,$tripId)
	{
		return invokeGetRequest("boardingPoint?id=".$boarding."&tripId=".$tripId);
	}

	function getTripDetails($tripId)
	{
		return invokeGetRequest("tripdetails?id=".$tripId); 	
	}
	
	function block($blockRequest)
	{	
		
		/*foreach($blockRequest->inventoryItems as $inventory)
		{
			echo "</hr></br>Seat Name:".$inventory->name;
			echo "</hr></br>Fare:".$inventory->fare;
			echo "</hr></br>Gender:".$inventory->ladiesSeat."</hr></br>";
		}*/
		return invokePostRequest("blockTicket",$blockRequest); 
	}

	function confirmTicket($blockKey)
	{
			return invokePostRequest("bookticket?blockKey=".$blockKey,"");
	} 
	function getTicketDetails($ticketId)
	{
		
		return invokeGetRequest("ticket?tin=".$ticketId);
	}

	function getTicketCancellationDetails($cancellationId)
	{
		return invokeGetRequest("cancellationdata?tin=".$cancellationId);
		echo " <hr>The ticket details are:".$cancellationId."<hr/>";
	}

	function cancelTicket($cancelRequest)
	{
		return invokePostRequest("cancelticket",$cancelRequest);
	}
?>
