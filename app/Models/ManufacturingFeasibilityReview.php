<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingFeasibilityReview extends Model
{
    use HasFactory;
<<<<<<< HEAD


    /**
     * Get the Timing Plan that owns the ProductInformationData
=======
    /**
     * Get the timing_plan that owns the ManufacturingFeasibilityReview
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timing_plan()
    {
        return $this->belongsTo(APQPTimingPlan::class, 'apqp_timing_plan_id');
    }
}
