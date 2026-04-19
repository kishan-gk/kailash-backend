<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Company extends Model {
    protected $fillable = ['name','logo','period','start_date','end_date','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
    public function roles() {
        return $this->hasMany(Role::class)->orderBy('sort_order');
    }
}
