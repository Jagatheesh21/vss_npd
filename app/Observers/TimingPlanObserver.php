<?php

namespace App\Observers;

use App\Models\APQPTimingPlan;

class TimingPlanObserver
{
    /**
     * Handle the APQPTimingPlan "created" event.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return void
     */
    public function created(APQPTimingPlan $aPQPTimingPlan)
    {

        //Mail::to('edp@venkateswarasteels.com')->send(new MailableClass);
        
    }

    /**
     * Handle the APQPTimingPlan "updated" event.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return void
     */
    public function updated(APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }

    /**
     * Handle the APQPTimingPlan "deleted" event.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return void
     */
    public function deleted(APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }

    /**
     * Handle the APQPTimingPlan "restored" event.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return void
     */
    public function restored(APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }

    /**
     * Handle the APQPTimingPlan "force deleted" event.
     *
     * @param  \App\Models\APQPTimingPlan  $aPQPTimingPlan
     * @return void
     */
    public function forceDeleted(APQPTimingPlan $aPQPTimingPlan)
    {
        //
    }
    public function scheduler_update(APQPTimingPlan $aPQPTimingPlan)
    {
        Mail::to('edp@venkateswarasteels.com')->view('email.test');
    }
}
