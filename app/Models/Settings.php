<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    
    protected $fillable = [
        'translation_lang', 'translation_of', 'title', 'slug', 'logo', 'active', 'keywords', 'description', 'created_at', 'updated_at'
    ];
    
    public function scopeActive($query){
        return $query -> where('active',1);
    }
    
    public function  scopeSelection($query){
        
        return $query -> select('id', 'translation_lang', 'translation_of', 'title', 'slug', 'logo', 'active', 'keywords', 'description');
    }
    
    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    
    public function scopeDefaultSetting($query){
        return  $query -> where('translation_of',0);
    }
    
    // get all translation categories
    public function settings()
    {
        return $this->hasMany(self::class, 'translation_of');
    }
    
}