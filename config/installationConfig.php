<?php

return [
    'test_user' => [
       'firstname' => 'Timothy',
        'lastname'   => 'Tim',
        'middlename'  => 'Timo',
        'email'     => 'timothy33.tf@gmail.com',
    ],

    'stations' => [
        ['name' => '5th' , 'zone' => '1' ],
        ['name' => 'Pelham Parkway' , 'zone' => '1' ],
        ['name' => 'Pelham Parkway' , 'zone' => '2' ],
        ['name' => 'Bronx' , 'zone' => '3' ],
        ['name' => 'Guns Hill' , 'zone' => '2' ],
    ],

    'fares'   => [
        ['takeoff_zone' => 1, 'destination_zone' => 1, 'amount' => 2.50],
        ['takeoff_zone' => 2, 'destination_zone' => 2, 'amount' => 2.00],
        ['takeoff_zone' => 3, 'destination_zone' => 3, 'amount' => 2.00],
        ['takeoff_zone' => 1, 'destination_zone' => 2, 'amount' => 3.00],
        ['takeoff_zone' => 2, 'destination_zone' => 1, 'amount' => 3.00],
        ['takeoff_zone' => 2, 'destination_zone' => 3, 'amount' => 2.25],
        ['takeoff_zone' => 3, 'destination_zone' => 2, 'amount' => 2.25],
        ['takeoff_zone' => 1, 'destination_zone' => 3, 'amount' => 3.20],
        ['takeoff_zone' => 3, 'destination_zone' => 1, 'amount' => 3.20],
        ['takeoff_zone' => 0, 'destination_zone' => 0, 'amount' => 1.80], //bus journey
    ],

];