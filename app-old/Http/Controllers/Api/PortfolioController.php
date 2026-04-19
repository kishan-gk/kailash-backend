<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Tool;
use App\Models\Company;
use App\Models\AboutSetting;
use App\Models\MarqueeItem;
use App\Models\NavLink;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    /**
     * GET /api/portfolio
     * Returns ALL portfolio data in one call
     */
    public function all(): JsonResponse
    {
        return response()->json([
            'hero' => $this->getHeroData(),
            'nav' => $this->getNavData(),
            'marquee' => $this->getMarqueeData(),
            'projects' => $this->getProjectsData(),
            'skills' => $this->getSkillsData(),
            'tools' => $this->getToolsData(),
            'experience' => $this->getExperienceData(),
            'about' => $this->getAboutData(),
        ]);
    }

    /** GET /api/portfolio/hero */
    public function hero(): JsonResponse
    {
        return response()->json($this->getHeroData());
    }

    /** GET /api/portfolio/nav */
    public function nav(): JsonResponse
    {
        return response()->json($this->getNavData());
    }

    /** GET /api/portfolio/marquee */
    public function marquee(): JsonResponse
    {
        return response()->json($this->getMarqueeData());
    }

    /** GET /api/portfolio/projects */
    public function projects(): JsonResponse
    {
        return response()->json($this->getProjectsData());
    }

    /** GET /api/portfolio/skills */
    public function skills(): JsonResponse
    {
        return response()->json($this->getSkillsData());
    }

    /** GET /api/portfolio/tools */
    public function tools(): JsonResponse
    {
        return response()->json($this->getToolsData());
    }

    /** GET /api/portfolio/experience */
    public function experience(): JsonResponse
    {
        return response()->json($this->getExperienceData());
    }

    /** GET /api/portfolio/about */
    public function about(): JsonResponse
    {
        return response()->json($this->getAboutData());
    }

    // ─── Private helpers ─────────────────────────────────────────────

    private function getHeroData(): array
    {
        $hero = HeroSetting::first();
        return $hero ? $hero->toArray() : [];
    }

    private function getNavData(): array
    {
        return NavLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['label', 'section_id'])
            ->toArray();
    }

    private function getMarqueeData(): array
    {
        return MarqueeItem::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['name', 'logo'])
            ->toArray();
    }

    private function getProjectsData(): array
    {
        return Project::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    private function getSkillsData(): array
    {
        return Skill::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    private function getToolsData(): array
    {
        return Tool::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    private function getExperienceData(): array
    {
        return Company::where('is_active', true)
            ->with(['roles' => fn($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    private function getAboutData(): array
    {
        $about = AboutSetting::first();
        return $about ? $about->toArray() : [];
    }
}
