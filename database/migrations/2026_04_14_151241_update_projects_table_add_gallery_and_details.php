<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Remove old image columns
            $table->dropColumn(['before_image', 'after_image', 'image']);

            // Add new fields
            $table->string('featured_image')->nullable()->after('description');
            $table->json('gallery_images')->nullable()->after('featured_image');
            $table->string('category')->nullable()->after('client_name');
            $table->string('location')->nullable()->after('category');
            $table->string('area')->nullable()->after('location');
            $table->string('completion_date')->nullable()->after('area');
            $table->string('project_manager')->nullable()->after('completion_date');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['featured_image', 'gallery_images', 'category', 'location', 'area', 'completion_date', 'project_manager']);

            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
            $table->string('image')->nullable();
        });
    }
};
