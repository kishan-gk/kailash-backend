<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AboutSetting extends Model {
    protected $fillable = ['heading','bio','years_experience','projects_count','education','email','phone','linkedin_url','instagram_url','behance_url','github_url','dribbble_url','profile_image'];
}
