<?php

namespace Database\Seeders;

use App\Models\Request_status;
use App\Models\Round_status;
use Illuminate\Database\Seeder;

class RoundStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'بدأت',
            'إنتهت',





        ];
   // for update data commit olde and open new and udate admin user
        // foreach ($status as $type) {

            Round_status::create(['id'=>1,'round_status' => ' بدأ']);
            Round_status::create(['id'=>2,'round_status' => 'أنتهت']);

        // }
    }
}
