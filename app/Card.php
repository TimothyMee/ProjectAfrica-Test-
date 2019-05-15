<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['user_id', 'card_no', 'amount'];

    public function createNew($data)
    {
        return $this->create($data);
    }

    public function updateCardAmount($data)
    {
        return $this->where('card_no', $data['card_no'])
                    ->update(
                        [
                            'amount' => $data['amount']
                        ]
                    );
    }

    public function viewUserCard($data)
    {
        return $this->where('user_id', $data['user_id'])->first();
    }
}
