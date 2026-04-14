<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->after('id')->constrained('services')->nullOnDelete();
            $table->text('description')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'description']);
        });
    }
};
