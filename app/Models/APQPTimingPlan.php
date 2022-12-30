<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APQPTimingPlan extends Model
{
    use HasFactory;
    protected $table = 'apqp_timing_plans';
    protected $fillable = ['apqp_timing_plan_number','part_number_id','revision_number','issuance_number','revision_date','issuance_date','customer_id','supplier','remarks'];

    /**
     * Get the user that owns the APQPTimingPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'current_stage_id');
    }
    public function sub_stage()
    {
        return $this->belongsTo(SubStage::class, 'current_sub_stage_id');
    }
    public function part_number()
    {
        return $this->belongsTo(PartNumber::class, 'part_number_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function activites()
    {
        return $this->hasMany(APQPPlanActivity::class,'apqp_timing_plan_id');
    }
    public function stages()
    {
        return $this->hasMany(APQPPlanActivity::class,'stage_id');
    }
    public function sub_stages()
    {
        return $this->hasMany(APQPPlanActivity::class,'sub_stage_id','id');
    }

    // public function scopeActiveTasks($query)
    // {
    //     return $query->where();
    // }
}
