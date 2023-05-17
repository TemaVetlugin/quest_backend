<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function hints(){
        return $this->hasMany(Hint::class, 'task_id','id');
    }
}
