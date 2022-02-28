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
        // foreach ($status as $type) {
        Certificate_status::create(['id'=>1,'certificate_status' => 'لم يتم حجزها']);
        Certificate_status::create(['id'=>2,'certificate_status' => 'جاهزة للطباعه']);
        Certificate_status::create(['id'=>3,'certificate_status' => 'تم طبعها']);
        Certificate_status::create(['id'=>4,'certificate_status' => 'تم الالغاء']);
        // }
    }
}
