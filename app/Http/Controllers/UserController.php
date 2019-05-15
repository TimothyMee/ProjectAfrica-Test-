<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request, User $user, Card $card)
    {
        try
        {
            $newUser = $user->createNew($request->all());
            if ($newUser){
                $cardNo = createCardNo($newUser["firstname"], $newUser["lastname"]);
                $newCardData = [
                    "user_id" => $newUser["id"],
                    "card_no" => $cardNo,
                    "amount" => 30,
                ];
                $newCard = $card->createNew($newCardData);

                if($newCard)
                {
                    return "successfully created a new user";
                }
            }
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
