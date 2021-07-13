<?php

namespace Database\Seeders;

use App\Models\OrderStatus as ModelsOrderStatus;
use Illuminate\Database\Seeder;

class OrderStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = ['created_at' => now(), 'updated_at' => now()];

        ModelsOrderStatus::insert([
            array_merge([
                'name' => 'Failed',
            ], $timestamp),
            array_merge([
                'name' => 'Shiping',
            ], $timestamp),
            array_merge([
                'name' => 'Success',
            ], $timestamp),
            array_merge([
                'name' => 'Cancelled',
            ], $timestamp),
            array_merge([
                'name' => 'Waiting Payment',
            ], $timestamp),
        ]);
    }
}
