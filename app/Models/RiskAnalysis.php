<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAnalysis extends Model
{
    use HasFactory;
    protected $fillable = ['apqp_timing_plan_id','part_number_id',''];
}
