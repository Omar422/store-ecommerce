<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setManySettings([
            'default_locale'            =>  'ar',
            'default_timezone'          =>  'Asia/Riyadh',
            'reviews_enabled'           =>  true,
            'auto_approve_reviews'      =>  true,
            'supported_currencies'      =>  ['USD', 'SAR'],
            'default_currency'          =>  'SAR',
            'store_email'               =>  'om.dev.422@gmail.com',
            'serach_engine'             =>  'mysql',
            'free_shipping_cost'        =>  0,
            'locale_shipping_cost'      =>  0,
            'outer_shipping_cost'       =>  0,
            'translatable'    =>  [
                'store_name'            => 'Store',
                'free_shipping_label'   => 'Free Shipping',
                'local_shipping_label'  => 'Local Shipping',
                'outer_shipping_label'  => 'Outer Shipping'
            ],
        ]);
    }
}
