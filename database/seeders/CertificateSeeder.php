<?php

namespace Database\Seeders;

use App\Models\Certificate_status;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'لم يتم حجزها',
            'جاهزة للطباعه',
            'تم طبعها',
            'تم الالغاء',




        ];
   // for update data commit olde and open new and udate admin user
        foreach ($status as $type) {
        Certificate_status::create(['certificate_status' => $type]);
        }
    }
}
