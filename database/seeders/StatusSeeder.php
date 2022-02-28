<?php

namespace Database\Seeders;

use App\Models\Request_status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'سدد بالكامل',
            'سداد جزئى',
            'لم يسدد',
            'فى الانتظار',




        ];
   // for update data commit olde and open new and udate admin user
        // foreach ($status as $type) {

            Request_status::create(['id'=>1,'request_status' => 'سدد بالكامل']);
            Request_status::create(['id'=>2,'request_status' => 'سداد جزئى']);
            Request_status::create(['id'=>3,'request_status' => 'لم يسدد']);
            Request_status::create(['id'=>4,'request_status' => 'فى الانتظار']);
        // }
    }
}
