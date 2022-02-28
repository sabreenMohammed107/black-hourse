<?php

namespace Database\Seeders;

use App\Models\Request_status;
use App\Models\Sale_funnel;
use Illuminate\Database\Seeder;

class SaleFunnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'مهتم',
            'غير مهتم',





        ];
   // for update data commit olde and open new and udate admin user
        // foreach ($status as $type) {

            Sale_funnel::create(['id'=>1,'sale_funnel' => 'مهتم']);
            Sale_funnel::create(['id'=>100,'sale_funnel' => 'غير مهتم']);

        // }
    }
}
