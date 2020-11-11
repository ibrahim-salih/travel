<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abouts extends Model
{
    protected $table = 'aboutus';
    
    protected $fillable = [
        'translation_lang', 'translation_of', 'title', 'slug', 'details', 'image', 'active', 'keywords', 'description', 'created_at', 'updated_at'
    ];
    
    public function scopeActive($query){
        return $query -> where('active',1);
    }
    
    public function  scopeSelection($query){
        
        return $query -> select('id', 'translation_lang', 'translation_of', 'title', 'slug', 'image', 'details', 'active', 'keywords', 'description');
    }
    
    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    
    public function scopeDefaultAbout($query){
        return  $query -> where('translation_of',0);
    }
    
    // get all translation categories
    public function abouts()
    {
        return $this->hasMany(self::class, 'translation_of');
    }
    
}