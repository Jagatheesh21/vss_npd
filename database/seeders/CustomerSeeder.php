<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'customer_type_id' => 1,
            'name' => 'BRAKES INDIA PRIVATE LIMITED',
            'contact_person' => 'MANAGER',
            'email' => 'manager@bipl.com',
            ]);
    }
}
