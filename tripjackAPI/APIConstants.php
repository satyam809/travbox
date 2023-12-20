<?php

// define('LIVEAPIMODE',true);

 define('LIVEAPIMODE',false);

if(LIVEAPIMODE)

{
   

	#============= Live SERVER CREDENTIALS =============#

	$hostName="https://api.tripjack.com";

	

	define('_API_KEY_','610937160b61a20a-6bf6-42c9-814e-fe56eb1815af');
	//define('_API_KEY_','7107618083ca16ac-81bc-4631-b800-bb04ea2ed4a6');
	define('_APISEARCH_',$hostName.'/fms/v1/air-search-all');

	define('_FARE_RULE_',$hostName.'/fms/v1/farerule');

	define('_REVIEW_SSR_',$hostName.'/fms/v1/review');

	define('_BOOKING_CONFIRM_URL_',$hostName.'/oms/v1/air/book');

	define('_BOOKING_DETAILS_URL_',$hostName.'/oms/v1/booking-details');
	define('_SEAT_MAP_',$hostName.'/fms/v1/seat');
	define('_CANCELLATION_',$hostName.'/oms/v1/air/amendment/submit-amendment');
	define('_CANCELLATION_DETAIL_',$hostName.'/oms/v1/air/amendment/amendment-details');
	define('_CANCELLATION_CHARGES_',$hostName.'/oms/v1/air/amendment/amendment-charges');           

	               

/*	define('APIAUTHENTICATE','https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate');

	define('APISEARCH','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Search/');

	define('APIFARERULE','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FareRule/');

	define('APIFAREQUOTE','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FAREQUOTE/');

	define('APIFARECONFIRM','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/PriceRBD/');

	define('APIBOOK','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Book/');

	define('APITICKET','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Ticket/');

	define('APIGETBOOKING','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetBookingDetails/');

	

	define('APISSR','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/SSR/');

	define('APIGETCALENDER','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetCalendarFare/');

	define('APICalendar','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/UpdateCalendarFareOfDay/');*/

	#============= Live SERVER CREDENTIALS =============#

}

else

{
    
   

	#============= TEST SERVER CREDENTIALS =============#

	$hostName="https://apitest.tripjack.com";

	

	define('_API_KEY_','712228a05a6bda-c0a0-4e7b-8ee2-b0f5c70b8d16'); //412064383aa387-3b04-4b58-9d8a-ce668d88889e

	define('_APISEARCH_',$hostName.'/fms/v1/air-search-all');

	define('_FARE_RULE_',$hostName.'/fms/v1/farerule');

	define('_REVIEW_SSR_',$hostName.'/fms/v1/review');

	define('_BOOKING_CONFIRM_URL_',$hostName.'/oms/v1/air/book');

	define('_BOOKING_DETAILS_URL_',$hostName.'/oms/v1/booking-details');
	define('_SEAT_MAP_',$hostName.'/fms/v1/seat');
	define('_CANCELLATION_',$hostName.'/oms/v1/air/amendment/submit-amendment');
	define('_CANCELLATION_DETAIL_',$hostName.'/oms/v1/air/amendment/amendment-details');
	define('_CANCELLATION_CHARGES_',$hostName.'/oms/v1/air/amendment/amendment-charges');
	

	



	

/*	define('APISEARCH','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search/');

	define('APIFARERULE','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FareRule/');

	define('APIFAREQUOTE','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FAREQUOTE/');

	define('APIFARECONFIRM','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/PriceRBD/');

	define('APIBOOK','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Book/');

	define('APITICKET','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Ticket/');

	define('APIGETBOOKING','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/GetBookingDetails/');

	

	define('APISSR','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/SSR/');

	define('APIGETCALENDER','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/GetCalendarFare/');

	define('APICalendar','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/UpdateCalendarFareOfDay/');*/





	#============= TEST SERVER CREDENTIALS =============#

	

}

?>