<?php

namespace Database\Seeders;

use App\Models\PaymentType as ModelsPaymentType;
use Illuminate\Database\Seeder;

class PaymentType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = ['created_at' => now(), 'updated_at' => now()];

        ModelsPaymentType::insert([
            array_merge([
                'name' => 'Prepaid Balance',
            ], $timestamp),
            array_merge([
                'name' => 'Product Page',
            ], $timestamp),
        ]);
    }
}
