<?php

namespace Database\Seeders;

use App\Models\Followup_type;
use App\Models\Request_status;
use Illuminate\Database\Seeder;

class FollowUpTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'مكالمة',
            'زيارة',





        ];
   // for update data commit olde and open new and udate admin user
        // foreach ($status as $type) {

        Followup_type::create(['id'=>1,'followup_name' => ' مكالمة']);
        Followup_type::create(['id'=>2,'followup_name' => ' زيارة']);

        // }
    }
}
