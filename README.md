# Portfolio CRM — Laravel 12
## Kailash ke Portfolio ke liye Backend CRM + REST API

---

## 🗂️ Project Structure

```
portfolio-crm/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── PortfolioController.php     ← Public API (React ke liye)
│   │   │   └── Admin/
│   │   │       ├── AuthController.php           ← Login/logout
│   │   │       ├── DashboardController.php      ← Dashboard
│   │   │       ├── ProjectController.php        ← Projects CRUD
│   │   │       ├── ExperienceController.php     ← Companies + Roles
│   │   │       ├── ContentControllers.php       ← Hero, About, Skills, Tools, Nav, Marquee
│   │   │       └── DashboardController.php
│   │   └── Middleware/
│   │       └── AdminAuth.php                    ← Session-based auth
│   ├── Models/
│   │   ├── HeroSetting.php
│   │   ├── Project.php
│   │   ├── Skill.php
│   │   ├── Tool.php
│   │   ├── Company.php
│   │   ├── Role.php
│   │   ├── AboutSetting.php
│   │   ├── MarqueeItem.php
│   │   └── NavLink.php
│   └── Providers/
│       └── AppServiceProvider.php
├── config/
│   ├── app.php
│   └── cors.php
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000001_create_portfolio_tables.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── layouts/
│   │   └── admin.blade.php                      ← Master layout (dark theme)
│   ├── admin/
│   │   ├── login.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── hero/edit.blade.php
│   │   ├── projects/{index,form}.blade.php
│   │   ├── experience/{index,form}.blade.php
│   │   ├── skills/{index,form}.blade.php
│   │   ├── tools/{index,form}.blade.php
│   │   ├── about/edit.blade.php
│   │   ├── nav/index.blade.php
│   │   └── marquee/index.blade.php
│   └── portfolioApi.ts                          ← React integration file
├── routes/
│   ├── web.php                                  ← Admin panel routes
│   └── api.php                                  ← Public API routes
└── .env.example
```

---

## ⚡ Installation — Step by Step

### Step 1: Laravel Install Karo

```bash
composer create-project laravel/laravel portfolio-crm
cd portfolio-crm
```

### Step 2: Is project ki files copy karo

Sari files apni jagah pe copy karo (structure upar diya hai).

### Step 3: .env Setup Karo

```bash
cp .env.example .env
php artisan key:generate
```

`.env` mein ye changes karo:
```env
DB_DATABASE=portfolio_crm
DB_USERNAME=root
DB_PASSWORD=your_password

# Aapki React portfolio ka URL
FRONTEND_URL=https://your-portfolio-site.com

# Admin login password (badlo!)
ADMIN_PASSWORD=apna_strong_password
```

### Step 4: Database Setup

```bash
# MySQL mein database banao
mysql -u root -p -e "CREATE DATABASE portfolio_crm;"

# Migrations run karo
php artisan migrate

# Sample data se populate karo
php artisan db:seed
```

### Step 5: Storage Link

```bash
php artisan storage:link
```

### Step 6: Server Chalao

```bash
php artisan serve
```

Ab browser mein kholo: **http://localhost:8000/admin**

---

## 🌐 API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/api/portfolio` | **Sari data ek saath** (recommended) |
| GET | `/api/portfolio/hero` | Hero section |
| GET | `/api/portfolio/nav` | Navigation links |
| GET | `/api/portfolio/marquee` | Marquee bar items |
| GET | `/api/portfolio/projects` | All projects |
| GET | `/api/portfolio/skills` | Skills/expertise |
| GET | `/api/portfolio/tools` | Tech tools (orbital) |
| GET | `/api/portfolio/experience` | Companies + roles |
| GET | `/api/portfolio/about` | About + contact + socials |

### Sample Response — `/api/portfolio`
```json
{
  "hero": {
    "badge_text": "UI/UX Designer • 2+ Years Experience",
    "headline_line1": "I Design Experiences,",
    "headline_line2": "Not Just Interfaces.",
    "headline_highlight_word": "Experiences",
    "description": "I'm a UI/UX designer...",
    "cta_button_text": "Let's Connect"
  },
  "projects": [
    {
      "id": 1,
      "title": "Zinigo",
      "description": "A comprehensive financial management...",
      "category": "SaaS Product",
      "image": "https://...",
      "brand_color": "#F97316"
    }
  ],
  "experience": [
    {
      "id": 1,
      "name": "BrainyDX",
      "period": "May 2025 – Present",
      "roles": [
        {
          "title": "Senior UI/UX Designer",
          "period": "May 2025 – Present",
          "description": ["Leading design team", "Spearheading design system"]
        }
      ]
    }
  ]
}
```

---

## ⚛️ React Portfolio Integration

### Step 1: API file copy karo

`resources/views/portfolioApi.ts` ko apni React project mein copy karo:
```
src/api/portfolioApi.ts
```

### Step 2: .env mein API URL add karo (React project mein)

```env
VITE_API_URL=http://localhost:8000
```

### Step 3: App.tsx update karo

```tsx
import { usePortfolioData } from './api/portfolioApi';

function App() {
  const { data, loading, error } = usePortfolioData();
  
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
```

---

## 🔐 Admin Panel

- URL: `/admin`
- Default Password: `admin123`
- Password change karo: `.env` mein `ADMIN_PASSWORD=naya_password`

### Admin Panel Features:
| Section | Kya kar sakte ho |
|---------|-----------------|
| Hero | Badge, headline, description, CTA button, logo |
| Projects | Add/edit/delete projects, image upload, brand color |
| Skills | Expertise cards manage karo with tags |
| Tech Tools | Orbital tools add/edit karo |
| Experience | Companies + multiple roles per company |
| About | Bio, stats, social links, profile image |
| Nav Links | Navigation bar links |
| Marquee | Scrolling brand bar |

---

## 🚀 Production Deployment

```bash
# Optimize karo
php artisan config:cache
php artisan route:cache
php artisan view:cache

# .env mein
APP_ENV=production
APP_DEBUG=false
```

**CORS**: Production mein `.env` mein apni portfolio site ka sahi URL daalo:
```env
FRONTEND_URL=https://kailash.design
```

---

## 📁 What's NOT included (standard Laravel files)

Ye files `composer create-project` se automatically aati hain:
- `bootstrap/`
- `vendor/`
- `public/index.php`
- `artisan`
- `composer.lock`

---

## ❓ Troubleshooting

**CORS error aa raha hai?**
→ `.env` mein `FRONTEND_URL` sahi set karo

**Admin login nahi ho raha?**
→ `.env` mein `ADMIN_PASSWORD` check karo

**API 404 return kar raha hai?**
→ `php artisan route:list` se check karo routes hain ya nahi
→ `php artisan route:cache` run karo

**Images upload nahi ho rahi?**
→ `php artisan storage:link` run karo
→ `storage/app/public` folder ka permission check karo: `chmod -R 775 storage`
