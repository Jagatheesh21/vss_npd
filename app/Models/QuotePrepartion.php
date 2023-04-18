<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotePrepartion extends Model
{
    use HasFactory;
    protected $fillable = ['apqp_timing_plan_id','stage_id','sub_stage_id','part_number_id','revision_number','revision_date','customer_id','application','product_description','quote_document','remarks'];

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
