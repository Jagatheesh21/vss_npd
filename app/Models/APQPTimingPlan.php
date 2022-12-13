<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APQPTimingPlan extends Model
{
    use HasFactory;
    protected $table = 'apqp_timing_plans';
    protected $fillable = ['apqp_timing_plan_number','format_number','issuance_number','revision_number','revision_date','issuance_date','customer_id','supplier',''];

    /**
     * Get the user that owns the APQPTimingPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
    public function sub_stage()
    {
        return $this->belongsTo(SubStage::class, 'stage_id');
    }

}
