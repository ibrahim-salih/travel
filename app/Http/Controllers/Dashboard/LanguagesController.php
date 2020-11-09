<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Requests\LanguageRequest;

class LanguagesController extends Controller
{
    
    public function index(){
        $languages = Language::select()->paginate(10);
        return view('dashboard.languages.index', compact('languages'));
    }
    
    public function create(){
        return view('dashboard.languages.create');
    }
    
    public function store(LanguageRequest $request){
        
        try {
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        }catch (\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطاء ما يرجى المحاولة فيما بعد']);
        }
        
    }
    
    public function edit($id){
        $language = Language::select()->find($id);
        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'لا توجد بيانات']);
        }
        return view('dashboard.languages.edit', compact('language'));
    }
    
    public function update($id, LanguageRequest $request){
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit')->with(['error' => 'هذه اللغة غير موجودة']);
            }
            if(!$request -> has('active'))
            $request -> request->add(['active' => 0]);
            
            $language -> update($request -> except('token'));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
            
        }catch (\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطاء ما يرجى المحاولة فيما بعد']);
        }
    }
    
    public function destroy($id){
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة']);
            }                
                $language -> delete();
                return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);
                
        }catch (\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطاء ما يرجى المحاولة فيما بعد']);
        }
    }
    
}
