<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $updates = [
            'site_name' => [
                'from' => 'Ecoscapes Landscaping Pvt Ltd',
                'to' => 'SR Greenscapes Pvt Ltd',
            ],
            'meta_title' => [
                'from' => 'Ecoscapes - Professional Landscaping Services',
                'to' => 'SR Greenscapes - Professional Landscaping Services',
            ],
            'copyright_text' => [
                'from' => 'Copyright 2025 Ecoscapes All rights reserved.',
                'to' => '© 2025 SR Greenscapes Pvt Ltd. All rights reserved.',
            ],
            'email' => [
                'from' => 'info@ecoscapes.in',
                'to' => 'info@srgreenscapes.com',
            ],
        ];

        foreach ($updates as $key => $values) {
            DB::table('settings')
                ->where('key', $key)
                ->where('value', $values['from'])
                ->update(['value' => $values['to']]);
        }
    }

    public function down(): void
    {
        $updates = [
            'site_name' => [
                'from' => 'SR Greenscapes Pvt Ltd',
                'to' => 'Ecoscapes Landscaping Pvt Ltd',
            ],
            'meta_title' => [
                'from' => 'SR Greenscapes - Professional Landscaping Services',
                'to' => 'Ecoscapes - Professional Landscaping Services',
            ],
            'copyright_text' => [
                'from' => '© 2025 SR Greenscapes Pvt Ltd. All rights reserved.',
                'to' => 'Copyright 2025 Ecoscapes All rights reserved.',
            ],
            'email' => [
                'from' => 'info@srgreenscapes.com',
                'to' => 'info@ecoscapes.in',
            ],
        ];

        foreach ($updates as $key => $values) {
            DB::table('settings')
                ->where('key', $key)
                ->where('value', $values['from'])
                ->update(['value' => $values['to']]);
        }
    }
};
