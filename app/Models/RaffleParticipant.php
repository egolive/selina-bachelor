<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaffleParticipant extends Model
{
    protected $table = 'raffle_participants';

    protected $fillable = ['code', 'winner', 'voucher_link', 'count'];
}
