<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contributions extends Model
{
    use HasFactory;
    protected $fillable=[
        'members_id',
        'Donation_amount',


        'currency',
    ];
public function team():BelongsTo{
    return $this->belongsTo(Team::class);
}
}
