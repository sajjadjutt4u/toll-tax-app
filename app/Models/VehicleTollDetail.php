<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTollDetail extends Model
{
    use HasFactory;
    protected $fillable = ['number_plate', 'entry_interchange', 'exit_interchange', 'entry_date_time', 'exit_date_time'];
}
