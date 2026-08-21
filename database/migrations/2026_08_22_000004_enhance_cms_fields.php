<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Projects: add bilingual, featured, published, slug, short description
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'title_bn')) {
                $table->string('title_bn')->nullable()->after('title');
            }
            if (!Schema::hasColumn('projects', 'title_en')) {
                $table->string('title_en')->nullable()->after('title_bn');
            }
            if (!Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title_en');
            }
            if (!Schema::hasColumn('projects', 'short_description')) {
                $table->text('short_description')->nullable()->after('description');
            }
            if (!Schema::hasColumn('projects', 'short_description_bn')) {
                $table->text('short_description_bn')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('projects', 'short_description_en')) {
                $table->text('short_description_en')->nullable()->after('short_description_bn');
            }
            if (!Schema::hasColumn('projects', 'description_bn')) {
                $table->text('description_bn')->nullable()->after('description');
            }
            if (!Schema::hasColumn('projects', 'description_en')) {
                $table->text('description_en')->nullable()->after('description_bn');
            }
            if (!Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('status');
            }
            if (!Schema::hasColumn('projects', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('is_featured');
            }
            if (!Schema::hasColumn('projects', 'is_program')) {
                $table->boolean('is_program')->default(false)->after('is_published');
            }
        });

        // Project categories: add is_active, sort_order, image
        Schema::table('project_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('project_categories', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('color');
            }
            if (!Schema::hasColumn('project_categories', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
            if (!Schema::hasColumn('project_categories', 'image')) {
                $table->string('image')->nullable()->after('icon');
            }
        });

        // Blog posts: add bilingual, featured, published_at
        Schema::table('blog_posts', function (Blueprint $table) {
            if (!Schema::hasColumn('blog_posts', 'title_bn')) {
                $table->string('title_bn')->nullable()->after('title');
            }
            if (!Schema::hasColumn('blog_posts', 'title_en')) {
                $table->string('title_en')->nullable()->after('title_bn');
            }
            if (!Schema::hasColumn('blog_posts', 'content_bn')) {
                $table->longText('content_bn')->nullable()->after('content');
            }
            if (!Schema::hasColumn('blog_posts', 'content_en')) {
                $table->longText('content_en')->nullable()->after('content_bn');
            }
            if (!Schema::hasColumn('blog_posts', 'excerpt_bn')) {
                $table->text('excerpt_bn')->nullable()->after('excerpt');
            }
            if (!Schema::hasColumn('blog_posts', 'excerpt_en')) {
                $table->text('excerpt_en')->nullable()->after('excerpt_bn');
            }
            if (!Schema::hasColumn('blog_posts', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('is_published');
            }
            if (!Schema::hasColumn('blog_posts', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_featured');
            }
            if (!Schema::hasColumn('blog_posts', 'seo_title')) {
                $table->string('seo_title')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('blog_posts', 'seo_description')) {
                $table->text('seo_description')->nullable()->after('seo_title');
            }
        });

        // Blog categories: add is_active
        Schema::table('blog_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('blog_categories', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }
        });

        // Gallery albums: add bilingual, featured
        Schema::table('gallery_albums', function (Blueprint $table) {
            if (!Schema::hasColumn('gallery_albums', 'title_bn')) {
                $table->string('title_bn')->nullable()->after('title');
            }
            if (!Schema::hasColumn('gallery_albums', 'title_en')) {
                $table->string('title_en')->nullable()->after('title_bn');
            }
            if (!Schema::hasColumn('gallery_albums', 'description_bn')) {
                $table->text('description_bn')->nullable()->after('description');
            }
            if (!Schema::hasColumn('gallery_albums', 'description_en')) {
                $table->text('description_en')->nullable()->after('description_bn');
            }
            if (!Schema::hasColumn('gallery_albums', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('is_published');
            }
            if (!Schema::hasColumn('gallery_albums', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_featured');
            }
        });

        // Gallery items: add bilingual caption, is_published
        Schema::table('gallery_items', function (Blueprint $table) {
            if (!Schema::hasColumn('gallery_items', 'caption_bn')) {
                $table->string('caption_bn')->nullable()->after('caption');
            }
            if (!Schema::hasColumn('gallery_items', 'caption_en')) {
                $table->string('caption_en')->nullable()->after('caption_bn');
            }
            if (!Schema::hasColumn('gallery_items', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('order');
            }
        });

        // Contact messages: ensure status is correct (already is new/read/replied/closed, so no is_read needed)
        // Add reply fields if not exists
        Schema::table('contact_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_messages', 'reply')) {
                $table->text('reply')->nullable()->after('message');
            }
            if (!Schema::hasColumn('contact_messages', 'replied_at')) {
                $table->timestamp('replied_at')->nullable()->after('reply');
            }
            if (!Schema::hasColumn('contact_messages', 'assigned_to')) {
                $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->after('replied_at');
            }
        });

        // Donation funds: ensure suggested_amounts is text for JSON
        // This was already text in migration, but fix if needed
    }

    public function down(): void
    {
        // No down for safety - keep columns
    }
};
