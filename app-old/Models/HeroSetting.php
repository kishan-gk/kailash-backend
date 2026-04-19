<?php
// app/Models/HeroSetting.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HeroSetting extends Model {
    protected $fillable = ['badge_text','headline_line1','headline_line2','headline_highlight_word','description','cta_button_text','cta_button_url','logo_image'];
}
