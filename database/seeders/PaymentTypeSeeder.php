<?php

namespace Database\Seeders;

use App\Models\Payment_type;
use App\Models\Request_status;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'حجز بدون تحديد',
            'حجز دورة',
            'استكمال دفع',
            'إيجار قاعه',
            'حجز شهادة',
            'حجز دبلومة',





        ];
   // for update data commit olde and open new and udate admin user
        // foreach ($status as $type) {

            Payment_type::create(['id'=>100,'payment_type' => 'حجز بدون تحديد','payment_flag'=>1]);
            Payment_type::create(['id'=>101,'payment_type' => 'حجز دورة','payment_flag'=>1]);
            Payment_type::create(['id'=>102,'payment_type' => 'استكمال دفع','payment_flag'=>1]);
            Payment_type::create(['id'=>103,'payment_type' => 'إيجار قاعه','payment_flag'=>1]);
            Payment_type::create(['id'=>104,'payment_type' => 'حجز شهادة','payment_flag'=>1]);
            Payment_type::create(['id'=>105,'payment_type' => 'حجز دبلومة','payment_flag'=>1]);
        // }
    }
}
