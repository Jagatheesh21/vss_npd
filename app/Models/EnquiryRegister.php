<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryRegister extends Model
{
    use HasFactory;
    protected $fillable =['apqp_timing_plan_id','stage_id','sub_stage_id','received_date','enquiry_type'];
}
