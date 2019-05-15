<?php

namespace App\Http\Controllers;

use App\Card;
use App\Station;
use App\Trip;
use App\User;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trip = new Trip();
        $station = new Station();
        $user = new User();

        $inactiveTrips = $trip->viewAllInactive();
        $trips = $trip->viewAll();
        $stations = $station->viewAll();
        $users = $user->viewAll();

        return view('welcome', ['trips' => $trips, 'stations' => $stations, 'users' => $users, 'inactiveTrips' => $inactiveTrips]);
    }
    public function startTrip(Request $request, Trip $trip, Card $card, Station $station)
    {
       try{
           $request = $request->all();
           //get destination station and takeoff station details
           $takeoffStation = $station->getStationByID(["id" => $request["takeoff"]]);
           $destinationStation = $station->getStationByID(["id" => $request["destination"]]);

           if($request['bus'] == "Yes"){
               $request['amount'] = 1.80;
               $request['bus'] = true;
           }
           else{
               $request['amount'] = 3.20;
               $request['bus'] = false;
           }

           //get the card current amount and see if it can take another trip
           $cardDetails = $card->viewUserCard($request);
           $newAmount = $cardDetails["amount"] - $request["amount"];
           if($newAmount < 0){
               return "You don't have sufficient amount in your card for this transaction";
           }
           $newTrip = $trip->createNew($request);

           //deduct from card
           $cardDetails["amount"] = $newAmount;
           $newCardDetails = $card->updateCardAmount($cardDetails);

           return "You have started a new trip <a href='/'> return to home";
       }
       catch (\Exception $e){
           return $e;
       }
    }
    public function endTrip(Request $request, Trip $trip, Card $card, Station $station)
    {
        try
        {
            $request = $request->all();
            //get trip
            $userTrip = $trip->getTripByID($request);
            //get destination station and takeoff station details
            $takeoffStation = $station->getStationByID(["id" => $userTrip["takeoff"]]);
            $destinationStation = $station->getStationByID(["id" => $userTrip["destination"]]);

            if(!$userTrip['bus']){
                if($takeoffStation["double_zone"] == 1){
                    //check the zone of the departure station and set the amount
                    $zone = $destinationStation["zone"];
                    if($zone == $takeoffStation["zone"] || $zone == $takeoffStation["zone2"]){
                        $userTrip["amount"] = 2.50;
                    }
                }
                elseif($destinationStation["double_zone"] == 1){
                    //check the zone of the takeoff station and set the amount
                    $zone = $takeoffStation["zone"];
                    if($zone == $destinationStation["zone"] || $zone == $destinationStation["zone2"]){
                        $userTrip["amount"] = 2.50;
                    }
                }
                else{
                    //get amount for the trip
                    $faresCollection = collect(config('installationConfig.fares'));
                    $fareamount = $faresCollection->where('takeoff_zone', $takeoffStation["zone"])
                                                    ->where('destination_zone', $destinationStation["zone"])
                                                    ->first();
                    $fareamount = $fareamount["amount"];
                    $userTrip["amount"] = $fareamount;
                }
            }

            //update card amount and trip amount
            $cardDetails = $card->viewUserCard($userTrip);
            $tripDifference = 3.20 - $userTrip["amount"];

            $cardDetails["amount"] = $cardDetails["amount"] + $tripDifference;
            $newCardDetails = $card->updateCardAmount($cardDetails);
            $newTripDetails = $trip->updateTripAmountAndEndTrip($userTrip);

            return "Successfully ended the trip <a href='/'> return to home";
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }
}
