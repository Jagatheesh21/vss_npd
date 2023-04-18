<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSpecificRequirement extends Model
{
    use HasFactory;
<<<<<<< HEAD
    // protected $fillable = ['apqp_timing_plan_id','stage_id','sub_stage_id','part_number_id','revision_number','revision_date','application','customer_id','product_description','manufacturing_requirements','handling_requirements','marking_requirements','packing_preservation','delivery_requirements','document_requirements'];

        /**
=======
    protected $fillable = ['apqp_timing_plan_id','stage_id','sub_stage_id','part_number_id','revision_number','revision_date','application','customer_id','product_description','manufacturing_requirements','handling_requirements','marking_requirements','packing_preservation','delivery_requirements','document_requirements'];
    /**
>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
     * Get the Timing Plan that owns the ProductInformationData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timing_plan()
    {
        return $this->belongsTo(APQPTimingPlan::class, 'apqp_timing_plan_id');
    }
<<<<<<< HEAD
=======
    public function id()
    {
        return $this->belongsTo(APQPTimingPlan::class, 'apqp_timing_plan_id');
    }

>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
}
