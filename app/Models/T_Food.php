<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Food extends Model
{
    use HasFactory;
    protected $table = 't_food';
    protected $fillable = ['name', 'description','promotion_price','unit_price','produced_on','image'];
}
