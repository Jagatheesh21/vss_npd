<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APQPPlanActivity extends Model
{
    use HasFactory;
    protected $table = 'apqp_plan_activities';
    protected $fillable = ['apqp_timing_plan_id','stage_id','sub_stage_id','status'];
    
    /**
     * The roles that belong to the APQPPlanActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /**
     * Get the user that owns the APQPPlanActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(APQPTimingPlan::class, 'apqp_timing_plan_id');
    }
     public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function sub_stage()
    {
        return $this->belongsTo(SubStage::class, 'sub_stage_id');
    }
    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'apqp_plan_activities', 'apqp_timing_plan_id', 'stage_id');
    }
    public function sub_stages()
    {
        return $this->belongsToMany(SubStage::class, 'apqp_plan_activities', 'apqp_timing_plan_id', 'sub_stage_id');
    }

}
