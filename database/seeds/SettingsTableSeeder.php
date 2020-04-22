<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //BURAYA TABLOMA EKLENECEK VERİLERİ YAZDIM
        DB::table("settings")->insert(
            [
                [
                    "settings_description" => "Title",
                    "settings_key" => "title",
                    "settings_value" => "Laravel CMS",
                    "settings_type" => "text",
                    "settings_must" => 0,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Descripiton",
                    "settings_key" => "descripiton",
                    "settings_value" => "Laravel CMS Description",
                    "settings_type" => "text",
                    "settings_must" => 1,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Logo",
                    "settings_key" => "logo",
                    "settings_value" => "logo.png",
                    "settings_type" => "file",
                    "settings_must" => 2,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Icon",
                    "settings_key" => "icon",
                    "settings_value" => "icon.ico",
                    "settings_type" => "file",
                    "settings_must" => 3,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Keywords",
                    "settings_key" => "keywords",
                    "settings_value" => "laravel,cms,veysel",
                    "settings_type" => "text",
                    "settings_must" => 4,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Phone Home",
                    "settings_key" => "phone_sabit",
                    "settings_value" => "0850 XXX XX XX",
                    "settings_type" => "text",
                    "settings_must" => 5,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Phone GSM",
                    "settings_key" => "phone_gsm",
                    "settings_value" => "0537 930 70 38",
                    "settings_type" => "text",
                    "settings_must" => 6,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Mail",
                    "settings_key" => "mail",
                    "settings_value" => "veyselkartalms@gmail.com",
                    "settings_type" => "text",
                    "settings_must" => 7,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "District",
                    "settings_key" => "ilce",
                    "settings_value" => "Uskudar",
                    "settings_type" => "text",
                    "settings_must" => 8,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "City",
                    "settings_key" => "il",
                    "settings_value" => "Istanbul",
                    "settings_type" => "text",
                    "settings_must" => 9,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ],
                [
                    "settings_description" => "Adress",
                    "settings_key" => "adres",
                    "settings_value" => "Burhaniye",
                    "settings_type" => "text",
                    "settings_must" => 10,
                    "settings_delete" => "0", //NO DELETE
                    "settings_status" => "1"
                ]
            ]
        );
    }
}
