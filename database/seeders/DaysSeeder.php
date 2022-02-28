<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\Request_status;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'الاثنين',
            'الثلاثاء',
            'الاربعاء',
            'الخميس',
            'الجمعة',
            'السبت',
            'الاحد',




        ];
   // for update data commit olde and open new and udate admin user
        // foreach ($status as $type) {

            Day::create(['id'=>1,'name' => 'الاثنين']);
            Day::create(['id'=>2,'name' => 'الثلاثاء']);
            Day::create(['id'=>3,'name' => 'الاربعاء']);
            Day::create(['id'=>4,'name' => 'الخميس']);
            Day::create(['id'=>5,'name' => 'الجمعة']);
            Day::create(['id'=>6,'name' => 'السبت']);
            Day::create(['id'=>7,'name' => 'الاحد']);
        // }
    }
}
