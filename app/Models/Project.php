<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Project extends Model {
    protected $fillable = ['title','description','category','image','brand_color','case_study_url','case_study_content','sort_order','is_featured','is_active'];
    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];
}
