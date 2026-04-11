<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->foreignId('team_category_id')->nullable()->after('id')->constrained('team_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropForeign(['team_category_id']);
            $table->dropColumn('team_category_id');
        });
    }
};
