<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tool extends Model {
    protected $fillable = ['name','icon_url','icon_bg_color','orbit_level','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
