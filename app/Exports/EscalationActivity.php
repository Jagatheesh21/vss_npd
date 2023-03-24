<?php

namespace App\Exports;

use App\Models\APQPPLanActivity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class EscalationActivity implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('apqp.activity.escalation_export', [
            'activities' => APQPPLanActivity::with('plan','plan.part_number','plan.customer','stage','sub_stage','plan.status')->upcoming()->get()
        ]);
    }
}
