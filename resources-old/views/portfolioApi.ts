/**
 * ============================================================
 * portfolioApi.ts
 * ============================================================
 * Yeh file aapki React portfolio mein daalni hai.
 * CRM se data fetch karegi aur sab components mein use hoga.
 *
 * SETUP:
 *   1. Yeh file copy karo: src/api/portfolioApi.ts
 *   2. .env mein set karo:
 *      VITE_API_URL=http://your-laravel-domain.com
 *   3. Har component mein import karo (examples neeche hain)
 * ============================================================
 */

const API_BASE = import.meta.env.VITE_API_URL
  ? `${import.meta.env.VITE_API_URL}/api/portfolio`
  : 'http://localhost:8000/api/portfolio';

// ─── Types ────────────────────────────────────────────────────────────────────

export interface HeroData {
  badge_text: string;
  headline_line1: string;
  headline_line2: string;
  headline_highlight_word: string;
  description: string;
  cta_button_text: string;
  cta_button_url: string | null;
  logo_image: string | null;
}

export interface NavLink {
  label: string;
  section_id: string;
}

export interface Project {
  id: number;
  title: string;
  description: string;
  category: string;
  image: string | null;
  brand_color: string;
  case_study_url: string | null;
  case_study_content: string | null;
  sort_order: number;
  is_featured: boolean;
}

export interface Skill {
  id: number;
  category: string;
  title: string;
  description: string;
  tags: string[];
  sort_order: number;
}

export interface Tool {
  id: number;
  name: string;
  icon_url: string | null;
  icon_bg_color: string | null;
  orbit_level: 'inner' | 'outer' | 'center';
  sort_order: number;
}

export interface Role {
  id: number;
  title: string;
  period: string;
  description: string[];
}

export interface Company {
  id: number;
  name: string;
  logo: string | null;
  period: string;
  sort_order: number;
  roles: Role[];
}

export interface AboutData {
  heading: string;
  bio: string;
  years_experience: number;
  projects_count: number;
  education: string;
  email: string | null;
  phone: string | null;
  linkedin_url: string | null;
  instagram_url: string | null;
  behance_url: string | null;
  github_url: string | null;
  dribbble_url: string | null;
  profile_image: string | null;
}

export interface MarqueeItem {
  name: string;
  logo: string | null;
}

export interface PortfolioData {
  hero: HeroData;
  nav: NavLink[];
  marquee: MarqueeItem[];
  projects: Project[];
  skills: Skill[];
  tools: Tool[];
  experience: Company[];
  about: AboutData;
}

// ─── Fetch helpers ────────────────────────────────────────────────────────────

async function fetchJson<T>(endpoint: string): Promise<T> {
  const res = await fetch(`${API_BASE}${endpoint}`, {
    headers: { 'Accept': 'application/json' },
  });
  if (!res.ok) throw new Error(`API error: ${res.status}`);
  return res.json();
}

// ─── API functions ────────────────────────────────────────────────────────────

/** Sab data ek call mein — RECOMMENDED */
export const fetchAll = () => fetchJson<PortfolioData>('');

export const fetchHero       = () => fetchJson<HeroData>('/hero');
export const fetchNav        = () => fetchJson<NavLink[]>('/nav');
export const fetchMarquee    = () => fetchJson<MarqueeItem[]>('/marquee');
export const fetchProjects   = () => fetchJson<Project[]>('/projects');
export const fetchSkills     = () => fetchJson<Skill[]>('/skills');
export const fetchTools      = () => fetchJson<Tool[]>('/tools');
export const fetchExperience = () => fetchJson<Company[]>('/experience');
export const fetchAbout      = () => fetchJson<AboutData>('/about');

// ─── React Hook ───────────────────────────────────────────────────────────────

import { useState, useEffect } from 'react';

export function usePortfolioData() {
  const [data, setData] = useState<PortfolioData | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    fetchAll()
      .then(setData)
      .catch(err => setError(err.message))
      .finally(() => setLoading(false));
  }, []);

  return { data, loading, error };
}

// ─── Usage Examples ───────────────────────────────────────────────────────────
/*

// 1. App.tsx mein sab data ek baar fetch karo aur props se pass karo:

import { usePortfolioData } from './api/portfolioApi';

function App() {
  const { data, loading } = usePortfolioData();
  if (loading) return <div>Loading...</div>;
  if (!data) return null;

  return (
    <>
      <Hero data={data.hero} />
      <Projects projects={data.projects} />
      <Experience companies={data.experience} />
      <About data={data.about} />
    </>
  );
}


// 2. Hero.tsx — update karo hardcoded text ko:

// PEHLE (hardcoded):
// <h1>I Design Experiences, Not Just Interfaces.</h1>

// AB (API se):
import { HeroData } from '../api/portfolioApi';

export function Hero({ data }: { data: HeroData }) {
  return (
    <section>
      <span>{data.badge_text}</span>
      <h1>
        {data.headline_line1}
        <br />
        {data.headline_line2}
      </h1>
      <p>{data.description}</p>
      <button>{data.cta_button_text}</button>
    </section>
  );
}


// 3. Projects.tsx — update karo:

import { Project } from '../api/portfolioApi';

export function Projects({ projects }: { projects: Project[] }) {
  return (
    <div>
      {projects.map(project => (
        <div key={project.id} style={{ borderColor: project.brand_color }}>
          <img src={project.image} alt={project.title} />
          <h3>{project.title}</h3>
          <p>{project.description}</p>
          <span>{project.category}</span>
        </div>
      ))}
    </div>
  );
}


// 4. Experience.tsx — update karo:

import { Company } from '../api/portfolioApi';

export function Experience({ companies }: { companies: Company[] }) {
  return (
    <div>
      {companies.map(company => (
        <div key={company.id}>
          <h3>{company.name}</h3>
          <span>{company.period}</span>
          {company.roles.map(role => (
            <div key={role.id}>
              <strong>{role.title}</strong>
              <span>{role.period}</span>
              <ul>
                {role.description.map((point, i) => (
                  <li key={i}>{point}</li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      ))}
    </div>
  );
}


// 5. About.tsx — update karo:

import { AboutData } from '../api/portfolioApi';

export function About({ data }: { data: AboutData }) {
  return (
    <section>
      <h2>{data.heading}</h2>
      <p>{data.bio}</p>
      <div>{data.years_experience}+ Experience</div>
      <div>{data.projects_count}+ Projects</div>
      <div>{data.education}</div>
      <a href={data.linkedin_url}>LinkedIn</a>
      <a href={data.instagram_url}>Instagram</a>
      <a href={data.behance_url}>Behance</a>
    </section>
  );
}

*/
