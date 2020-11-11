<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Contactus;
use App\Models\Settings;
use App\Models\Abouts;
use Intervention\Image\Facades\Image;
use App\Http\Requests\AboutWebRequest;
use App\Http\Requests\ContactWebRequest;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\SettingWebRequest;

class SettingsController extends Controller
{

    public function __construct()
    {
        // create read update delete
        $this->middleware([
            'permission:read_settings'
        ])->only('index');
        $this->middleware([
            'permission:create_settings'
        ])->only('create');
        $this->middleware([
            'permission:update_settings'
        ])->only('edit');
        $this->middleware([
            'permission:delete_settings'
        ])->only('destroy');
    }
    
    public function setting()
    {
        // get specific categories and its translations
        $setting = Settings::with('settings')->first();

        return view('dashboard.settings.setting', compact('setting'));
    }

    public function update($id, SettingWebRequest $request)
    {
        return $request;
        try {
            $main_setting = Settings::find($id);

            if (! $main_setting)
                return redirect()->route('admin.settings')->with([
                    'error' => 'This data is not found '
                ]);

            // update date

                $setting = array_values($request->settings)[0];
                //return $setting;


            Settings::where('id', $id)->update([
                'title' => $setting['title'],
                'description' => $setting['description'],
                'keywords' => $setting['keywords']
            ]);

            // save image

            if ($request->has('photo')) {
                Image::make($request->photo)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                    ->save(public_path('assets/images/settings/' . $request->photo->hashName()));

                $filePath = $request->photo->hashName();
                Settings::where('id', $id)->update([
                    'logo' => $filePath
                ]);
            }

            return redirect()->route('admin.settings')->with([
                'success' => 'The update was successful'
            ]);
        } catch (\Exception $ex) {
             //return $ex;
            return redirect()->route('admin.settings')->with([
                'error' => 'Something went wrong, please try again later'
            ]);
        }
    }

    public function about()
    {
        // get specific categories and its translations
        $about = Abouts::with('abouts')->first();
        
        return view('dashboard.settings.about', compact('about'));
    }

    public function update_about($id, AboutWebRequest $request)
    {
        try {
            $main_about = Abouts::find($id);
            if (! $main_about)
                return redirect()->route('admin.about')->with([
                    'error' => 'This data is not found '
                ]);
                // update date
                $about = array_values($request->abouts)[0];
                //return $setting;
                Abouts::where('id', $id)->update([
                    'title' => $about['title'],
                    'slug' => Str::slug($about['title'], '-'),
                    'details' => $about['details'],
                    'description' => $about['description'],
                    'keywords' => $about['keywords']
                ]);
                // save image
                if ($request->has('photo')) {
                    Image::make($request->photo)->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('assets/images/settings/' . $request->photo->hashName()));
                    $filePath = $request->photo->hashName();
                    Settings::where('id', $id)->update([
                        'image' => $filePath
                    ]);
                }
                return redirect()->route('admin.about')->with([
                    'success' => 'The update was successful'
                ]);
        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.about')->with([
                'error' => 'Something went wrong, please try again later'
            ]);
        }
    }

    public function contactus()
    {
        // get specific categories and its translations
        $contact = Contactus::with('contacts')->first();
        
        return view('dashboard.settings.contact', compact('contact'));
    }
    
    public function update_contact($id, ContactWebRequest $request){
        try {
            $main_contact = Contactus::find($id);
            
            if (! $main_contact)
                return redirect()->route('admin.contactus')->with([
                    'error' => 'This data is not found '
                ]);
                
                // update date
                
                $contact = array_values($request->contacts)[0];
                //return $setting;
                
                
                Contactus::where('id', $id)->update([
                    'address' => $contact['address'],
                    'email' => $contact['email'],
                    'phone' => $contact['phone'],
                    'fax' => $contact['fax'],
                    'link_face' => $contact['link_face'],
                    'link_youtube' => $contact['link_youtube'],
                    'contact_watsup' => $contact['contact_watsup'],
                    'link_twt' => $contact['link_twt']
                ]);
                
                
                return redirect()->route('admin.contactus')->with([
                    'success' => 'The update was successful'
                ]);
        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.contactus')->with([
                'error' => 'Something went wrong, please try again later'
            ]);
        }
    }
    
}