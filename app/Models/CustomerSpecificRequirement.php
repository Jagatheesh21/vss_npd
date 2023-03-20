<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSpecificRequirement extends Model
{
    use HasFactory;
    protected $fillable = ['apqp_timing_plan_id','stage_id','sub_stage_id','part_number_id','revision_number','revision_date','application','customer_id','product_description','manufacturing_requirements','handling_requirements','marking_requirements','packing_preservation','delivery_requirements','document_requirements'];
}
