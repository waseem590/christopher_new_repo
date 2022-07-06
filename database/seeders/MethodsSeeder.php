<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\method;
class MethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        method::create(
        [
            'name'=>'apple_pay'
        ]);
        method::create(
        [
            'name'=>'chime'
        ]);
        method::create(
        [
            'name'=>'venmo'
        ]);
        method::create(
        [
            'name'=>'square_cash'
        ]);
        method::create(
        [
            'name'=>'paypal'
        ]);
        method::create(
        [
            'name'=>'zelle'
        ]);
    }
}
