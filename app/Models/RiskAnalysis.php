<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAnalysis extends Model
{
    use HasFactory;
    protected $fillable = ['apqp_timing_plan_id','part_number_id',''];


    /**
     * Get the Timing Plan that owns the ProductInformationData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timing_plan()
    {
        return $this->belongsTo(APQPTimingPlan::class, 'apqp_timing_plan_id');
    }
}
