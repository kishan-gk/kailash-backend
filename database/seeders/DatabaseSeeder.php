<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Settings
        DB::table('hero_settings')->insert([
            'badge_text' => 'UI/UX Designer • 2+ Years Experience',
            'headline_line1' => 'I Design Experiences,',
            'headline_line2' => 'Not Just Interfaces.',
            'headline_highlight_word' => 'Experiences',
            'description' => "I'm a UI/UX designer focused on building intuitive, user-centered digital experiences, crafting modern interfaces for web, mobile, and SaaS products that users genuinely enjoy.",
            'cta_button_text' => "Let's Connect",
            'cta_button_url' => '#contact',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Nav Links
        $navLinks = [
            ['label' => 'Projects', 'section_id' => '#projects', 'sort_order' => 1],
            ['label' => 'Skills', 'section_id' => '#expertise', 'sort_order' => 2],
            ['label' => 'Experience', 'section_id' => '#experience', 'sort_order' => 3],
            ['label' => 'About Me', 'section_id' => '#about', 'sort_order' => 4],
            ['label' => 'Resume', 'section_id' => '#resume', 'sort_order' => 5, 'is_active' => true],
        ];
        foreach ($navLinks as $link) {
            DB::table('nav_links')->insert(array_merge($link, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Projects
        $projects = [
            [
                'title' => 'Zinigo',
                'description' => 'A comprehensive financial management platform for small businesses',
                'category' => 'SaaS Product',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
                'brand_color' => '#F97316',
                'sort_order' => 1,
            ],
            [
                'title' => 'Medicare',
                'description' => 'Healthcare appointment scheduling and telemedicine platform',
                'category' => 'Mobile App',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&q=80',
                'brand_color' => '#3B82F6',
                'sort_order' => 2,
            ],
            [
                'title' => 'Techstart',
                'description' => 'Modern landing page and marketing website for a tech startup',
                'category' => 'Website',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
                'brand_color' => '#10B981',
                'sort_order' => 3,
            ],
            [
                'title' => 'Taskpro',
                'description' => 'Project management tool with intuitive task tracking',
                'category' => 'SaaS Product',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80',
                'brand_color' => '#A855F7',
                'sort_order' => 4,
            ],
            [
                'title' => 'Novabank',
                'description' => 'Next-gen banking interface for digital nomads',
                'category' => 'Fintech',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&q=80',
                'brand_color' => '#EC4899',
                'sort_order' => 5,
            ],
            [
                'title' => 'Orbit',
                'description' => '3D interactive marketing site for space tourism',
                'category' => 'Web3',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80',
                'brand_color' => '#06B6D4',
                'sort_order' => 6,
            ],
        ];
        foreach ($projects as $project) {
            DB::table('projects')->insert(array_merge($project, [
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Skills
        $skills = [
            [
                'category' => 'EXPERTISE',
                'title' => 'UI Design',
                'description' => 'Crafting visually refined, accessible interfaces that translate ideas into intuitive digital experiences across web and mobile.',
                'tags' => json_encode(['Responsive design', 'High-fidelity screens', 'Design consistency & polish']),
                'sort_order' => 1,
            ],
            [
                'category' => 'EXPERTISE',
                'title' => 'UX Design',
                'description' => 'Designing user-centered experiences grounded in research, strategy, and empathy-driven problem solving.',
                'tags' => json_encode(['User research', 'Wireframing', 'Prototyping', 'Usability testing']),
                'sort_order' => 2,
            ],
            [
                'category' => 'EXPERTISE',
                'title' => 'Motion Design',
                'description' => 'Adding life to interfaces through purposeful animations and micro-interactions that guide and delight users.',
                'tags' => json_encode(['Micro-interactions', 'Page transitions', 'Lottie animations']),
                'sort_order' => 3,
            ],
        ];
        foreach ($skills as $skill) {
            DB::table('skills')->insert(array_merge($skill, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Tools
        $tools = [
            ['name' => 'Figma', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg', 'icon_bg_color' => '#1E1E1E', 'orbit_level' => 'outer', 'sort_order' => 1],
            ['name' => 'Adobe Illustrator', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/illustrator/illustrator-plain.svg', 'icon_bg_color' => '#FF7C00', 'orbit_level' => 'outer', 'sort_order' => 2],
            ['name' => 'JavaScript', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg', 'icon_bg_color' => '#F7DF1E', 'orbit_level' => 'outer', 'sort_order' => 3],
            ['name' => 'HTML5', 'icon_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg', 'icon_bg_color' => '#E34F26', 'orbit_level' => 'inner', 'sort_order' => 4],
            ['name' => 'Framer', 'icon_url' => '', 'icon_bg_color' => '#0055FF', 'orbit_level' => 'inner', 'sort_order' => 5],
        ];
        foreach ($tools as $tool) {
            DB::table('tools')->insert(array_merge($tool, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Companies / Experience
        $companies = [
            [
                'name' => 'BrainyDX',
                'period' => 'May 2025 – Present',
                'sort_order' => 1,
                'roles' => [
                    ['title' => 'Senior UI/UX Designer', 'period' => 'May 2025 – Present', 'description' => ['Leading the design team for enterprise solutions', 'Spearheading the new design system initiative', 'Collaborating with stakeholders to define product roadmap']],
                ],
            ],
            [
                'name' => 'Digital Innovations',
                'period' => 'Jan 2025 – Apr 2025',
                'sort_order' => 2,
                'roles' => [
                    ['title' => 'Senior UI Designer', 'period' => 'Jan 2025 – Apr 2025', 'description' => ['Designed high-fidelity interfaces for fintech products', 'Improved user engagement by 25% through UI optimizations', 'Mentored junior designers on visual design principles']],
                ],
            ],
            [
                'name' => 'Rablo.in',
                'period' => 'Aug 2024 – Jan 2025',
                'sort_order' => 3,
                'roles' => [
                    ['title' => 'UI/UX Trainee, Bootcamp', 'period' => 'First 15 Days', 'description' => ['Intensive training on UI/UX fundamentals', 'Completed capstone project', 'Learned agile methodologies']],
                    ['title' => 'UI/UX Designer', 'period' => 'Aug 2024 – Oct 2024', 'description' => ['Contributed to the core product design', 'Conducted user research and usability testing', 'Collaborated with cross-functional teams']],
                    ['title' => 'Associate UI/UX Designer', 'period' => 'Nov 2024 – Jan 2025', 'description' => ['Led an internal project end-to-end', 'Created and maintained the design system', 'Presented design solutions to leadership']],
                ],
            ],
        ];

        foreach ($companies as $companyData) {
            $roles = $companyData['roles'];
            unset($companyData['roles']);
            $companyId = DB::table('companies')->insertGetId(array_merge($companyData, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
            foreach ($roles as $i => $role) {
                DB::table('roles')->insert([
                    'company_id' => $companyId,
                    'title' => $role['title'],
                    'period' => $role['period'],
                    'description' => json_encode($role['description']),
                    'sort_order' => $i + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // About Settings
        DB::table('about_settings')->insert([
            'heading' => 'Turning ideas into meaningful digital',
            'bio' => "I'm a UI/UX Designer focused on creating intuitive, scalable digital experiences. I enjoy turning complex ideas into clear user journeys and polished interfaces across web and mobile products.",
            'years_experience' => 2,
            'projects_count' => 30,
            'education' => 'BCA',
            'email' => 'kailash.kr5508@gmail.com',
            'phone' => '+91 62964 17052',
            'linkedin_url' => '#',
            'instagram_url' => '#',
            'behance_url' => '#',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Marquee Items
        $marqueeItems = ['Techworld', 'BrainyDX', 'Kailash', 'Rablo.in', 'TechWorld', 'Digital'];
        foreach ($marqueeItems as $i => $name) {
            DB::table('marquee_items')->insert([
                'name' => $name,
                'sort_order' => $i + 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
