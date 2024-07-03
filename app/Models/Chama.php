<?php

namespace App\Models;

use App\Models\Contributions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chama extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'Number_of_members',
        'Chama_type',
        'currency',
    ];
    public function Contributions():BelongsTo
    {
        return $this->belongsTo(Contributions::class);
    }



}
