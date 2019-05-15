<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name', 'zone', 'double_zone', 'zone2'];

    public function createNew($data)
    {
        return $this->create($data);
    }

    public function getStationByID($data)
    {
        return $this->where('id', $data["id"])->first();
    }

    public function viewAll()
    {
        return $this->all();
    }
}
