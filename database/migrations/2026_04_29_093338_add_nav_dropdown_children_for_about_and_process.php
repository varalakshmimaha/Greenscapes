<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── About Us ────────────────────────────────────────────────────
        $about = DB::table('menus')->where('url', '/about')->whereNull('parent_id')->first();

        if ($about) {
            DB::table('menus')->where('id', $about->id)->update(['has_dropdown' => true]);

            foreach ([
                ['title' => 'Vision & Mission',       'url' => '/about#vision',       'order' => 1],
                ['title' => 'Core Values',             'url' => '/about#values',       'order' => 2],
                ['title' => 'What Makes Us Different', 'url' => '/about#different',    'order' => 3],
                ['title' => 'Team',                    'url' => '/about#team',         'order' => 4],
                ['title' => 'Testimonials',            'url' => '/about#testimonials', 'order' => 5],
            ] as $child) {
                if (!DB::table('menus')->where('parent_id', $about->id)->where('url', $child['url'])->exists()) {
                    DB::table('menus')->insert(array_merge($child, [
                        'parent_id' => $about->id, 'has_dropdown' => false,
                        'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
                    ]));
                }
            }
        }

        // ── Our Process ─────────────────────────────────────────────────
        $process = DB::table('menus')->where('url', '/process')->whereNull('parent_id')->first();

        if ($process) {
            DB::table('menus')->where('id', $process->id)->update(['has_dropdown' => true]);

            foreach ([
                ['title' => 'Our Process',       'url' => '/process',                    'order' => 1],
                ['title' => 'Why Choose Us',      'url' => '/process#why-choose-us',      'order' => 2],
                ['title' => 'Investment Factors', 'url' => '/process#investment-factors', 'order' => 3],
            ] as $child) {
                if (!DB::table('menus')->where('parent_id', $process->id)->where('url', $child['url'])->exists()) {
                    DB::table('menus')->insert(array_merge($child, [
                        'parent_id' => $process->id, 'has_dropdown' => false,
                        'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
                    ]));
                }
            }
        }

        // ── Fix Resource menu URL ────────────────────────────────────────
        DB::table('menus')->where('url', '/resource')->whereNull('parent_id')->update(['url' => '/resources']);
    }

    public function down(): void
    {
        $about   = DB::table('menus')->where('url', '/about')->whereNull('parent_id')->first();
        $process = DB::table('menus')->where('url', '/process')->whereNull('parent_id')->first();

        if ($about)   DB::table('menus')->where('parent_id', $about->id)->delete();
        if ($process) DB::table('menus')->where('parent_id', $process->id)->delete();
    }
};
