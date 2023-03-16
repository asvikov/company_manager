<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Company Name 1',
                'email' => 'email1@email.ru',
                'address' => 'улица Панфёрова, 6к2, Москва, 119261',
                'logo_url' => 'company_images/ABC-2021-LOGO.svg.png'
            ],
            [
                'name' => 'Company Name 2',
                'email' => 'email2@email.ru',
                'address' => 'улица Дениса Давыдова, 2с7, Москва, 121170',
                'logo_url' => 'company_images/ABC-2021-LOGO.svg.png'
            ],
            [
                'name' => 'Company Name 3',
                'email' => 'email3@email.ru',
                'address' => '2-й Красногвардейский проезд, 4Б, Москва, 123317',
                'logo_url' => 'company_images/ABC-2021-LOGO.svg.png'
            ]
        ]);
        DB::table('workers')->insert([
            [
                'name' => 'Worker Name 1',
                'email' => 'job1@email.ru',
                'phone' => '79110000000'
            ],
            [
                'name' => 'Worker Name 2',
                'email' => 'job2@email.ru',
                'phone' => '79110000002'
            ],
            [
                'name' => 'Worker Name 3',
                'email' => 'job3@email.ru',
                'phone' => '79110000003'
            ],
            [
                'name' => 'Worker Name 4',
                'email' => 'job4@email.ru',
                'phone' => '79110000004'
            ],
            [
                'name' => 'Worker Name 5',
                'email' => 'job5@email.ru',
                'phone' => '79110000000'
            ]
        ]);
        DB::table('company_worker')->insert([
            [
                'company_id' => '1',
                'worker_id' => '1'
            ],
            [
                'company_id' => '1',
                'worker_id' => '5'
            ],
            [
                'company_id' => '1',
                'worker_id' => '4'
            ],
            [
                'company_id' => '2',
                'worker_id' => '2'
            ],
            [
                'company_id' => '3',
                'worker_id' => '3'
            ]
        ]);
        DB::table('coordinates')->insert([
            [
                'company_id' => '1',
                'latitude' => '55.682200',
                'longitude' => '37.541809'
            ],
            [
                'company_id' => '2',
                'latitude' => '55.740258',
                'longitude' => '37.516960'
            ],
            [
                'company_id' => '3',
                'latitude' => '55.752914',
                'longitude' => '37.537202'
            ]
        ]);
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@email.ru',
                'password' => '$2y$10$gdSwp8LpL8hLg0SVvjCDvuunDMMobMP5qqUTmQye0Q4bSCYvCoLfC'
            ]
        ]);
    }
}
