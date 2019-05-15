<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['user_id', 'takeoff', 'destination', 'bus', 'amount', 'active'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function createNew($data)
    {
        return $this->create($data);
    }

    public function viewAllInactive()
    {
        return $this->with('user')->where("active", 1)->get();
    }

    public function viewAll()
    {
        return $this->with('user')->get();
    }

    public function viewUserTrip($data)
    {
        return $this->where('user_id', $data['user_id'])->get();
    }

    public function getTripByID($data)
    {
        return $this->where('id', $data["id"])->first();
    }

    public function updateTripAmountAndEndTrip($data)
    {
        return $this->where('user_id', $data['user_id'])
            ->update(
                [
                    'amount' => $data['amount'],
                    'active' => false
                ]
            );
    }
}
