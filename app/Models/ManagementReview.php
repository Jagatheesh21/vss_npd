<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementReview extends Model
{
    use HasFactory;

<<<<<<< HEAD
                /**
=======

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

>>>>>>> e8d11c1f377e3a56dfcdff8e5f33d85eba795026
}
