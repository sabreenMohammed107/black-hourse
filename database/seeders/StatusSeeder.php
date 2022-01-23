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
        foreach ($status as $type) {
            Request_status::create(['request_status' => $type]);
        }
    }
}
