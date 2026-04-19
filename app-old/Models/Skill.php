<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Skill extends Model {
    protected $fillable = ['category','title','description','tags','icon','sort_order','is_active'];
    protected $casts = ['tags' => 'array', 'is_active' => 'boolean'];
}
