<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EnquiryRegister extends Model
{
    use HasFactory;
    protected $fillable =['apqp_timing_plan_id','stage_id','sub_stage_id','received_date','enquiry_type','prepared_by','ern_sample','sir_sample','safe_launch_sample','verified_at','verified_date','status','approved_at','approved_by','remarks'];
    /**
     * Get the user that owns the EnquiryRegister
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timing_plan()
    {
        return $this->belongsTo(APQPTimingPlan::class, 'apqp_timing_plan_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function part_number()
    {
        return $this->belongsTo(PartNumber::class, 'part_number_id');
    }
}
