<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CustomersExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select('id','name','contact_person','email')->get();
    }
    public function headings(): array
    {
        return [
            'Sl.No',
            'Customer Name',
            'Contact Person',
            'Email Address',
        ];
    }
}
