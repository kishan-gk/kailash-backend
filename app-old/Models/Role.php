<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Role extends Model {
    protected $fillable = ['company_id','title','period','description','sort_order'];
    protected $casts = ['description' => 'array'];
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
