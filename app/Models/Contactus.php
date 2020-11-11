<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $table = 'contactus';
    
    protected $fillable = [
        'translation_lang', 'translation_of', 'address', 'lat', 'lon', 'contact_email', 'phone', 'fax', 'link_face', 'link_youtube', 'contact_watsup', 'link_twt', 'created_at', 'updated_at'
    ];
    
    public function scopeActive($query){
        return $query -> where('active',1);
    }
    
    public function  scopeSelection($query){
        
        return $query -> select('id', 'translation_lang', 'translation_of', 'address', 'lat', 'lon', 'contact_email', 'phone', 'fax', 'link_face', 'link_youtube', 'contact_watsup', 'link_twt');
    }
    
    public function scopeDefaultAbout($query){
        return  $query -> where('translation_of',0);
    }
    
    // get all translation categories
    public function contacts()
    {
        return $this->hasMany(self::class, 'translation_of');
    }
    
}