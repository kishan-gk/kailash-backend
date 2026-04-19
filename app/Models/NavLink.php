<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class NavLink extends Model {
    protected $fillable = ['label','section_id','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
