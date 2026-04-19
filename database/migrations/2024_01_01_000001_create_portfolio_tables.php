<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hero Section
        Schema::create('hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('UI/UX Designer • 2+ Years Experience');
            $table->string('headline_line1')->default('I Design Experiences,');
            $table->string('headline_line2')->default('Not Just Interfaces.');
            $table->string('headline_highlight_word')->default('Experiences');
            $table->text('description')->default("I'm a UI/UX designer focused on building intuitive, user-centered digital experiences, crafting modern interfaces for web, mobile, and SaaS products that users genuinely enjoy.");
            $table->string('cta_button_text')->default("Let's Connect");
            $table->string('cta_button_url')->nullable();
            $table->string('logo_image')->nullable();
            $table->timestamps();
        });

        // Navbar / Nav Links
        Schema::create('nav_links', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('section_id'); // e.g. #projects, #skills
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category'); // SaaS Product, Mobile App, Website, etc.
            $table->string('image')->nullable(); // URL or path
            $table->string('brand_color')->default('#6032F2');
            $table->string('case_study_url')->nullable();
            $table->text('case_study_content')->nullable(); // Full case study text/HTML
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Skills / Expertise
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // UI Design, UX Design, Motion, etc.
            $table->string('title');
            $table->text('description');
            $table->json('tags')->nullable(); // ['Responsive design', 'High-fidelity screens']
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tools (Orbital / Tech Stack)
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon_url')->nullable(); // image URL
            $table->string('icon_bg_color')->nullable();
            $table->string('orbit_level')->default('inner'); // inner, outer, center
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Experience / Companies
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable(); // image path
            $table->string('period');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('period');
            $table->json('description')->nullable(); // array of bullet points
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // About Section
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->default('Turning ideas into meaningful digital');
            $table->text('bio');
            $table->integer('years_experience')->default(2);
            $table->integer('projects_count')->default(30);
            $table->string('education')->default('BCA');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('behance_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('dribbble_url')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });

        // Marquee (Scrolling Brand Bar)
        Schema::create('marquee_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Site Settings (global)
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('marquee_items');
        Schema::dropIfExists('about_settings');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('tools');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('nav_links');
        Schema::dropIfExists('hero_settings');
    }
};
