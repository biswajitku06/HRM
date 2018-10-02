<?php

use Illuminate\Database\Seeder;
use App\Models\AdminSetting;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminSetting::create(['slug'=>'app_title','value'=>'HRM']);
        AdminSetting::create(['slug'=>'logo','value'=>'']);
        AdminSetting::create(['slug'=>'favicon','value'=>'']);
        AdminSetting::create(['slug'=>'copyright_text','value'=>'Copyright@2018']);
        AdminSetting::create(['slug'=>'pagination_count','value'=>'10']);
        AdminSetting::create(['slug'=>'point_rate','value'=>'1']);
    }
}
