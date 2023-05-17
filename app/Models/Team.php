<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function users(){
        return $this->hasMany(User::class, 'team_id','id');
    }
}
