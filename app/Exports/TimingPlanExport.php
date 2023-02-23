<?php

namespace App\Exports;

use App\Models\APQPPlanActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class TimingPlanExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return APQPPlanActivity::with('plan','stage','sub_stage')->get();
    }
    public function headings(): array
    {
        return [
            'Sl.No',
            'Timing Plan Number',
            'Stage',
            'Sub Stage',
        ];
    }
}
