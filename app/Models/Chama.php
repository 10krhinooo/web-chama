<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chama extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'max_members', 'special_code'];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
