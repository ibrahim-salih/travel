<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Config;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function __construct()
    {
        // create read update delete
        $this->middleware([
            'permission:read_users'
        ])->only('index');
        $this->middleware([
            'permission:create_users'
        ])->only('create');
        $this->middleware([
            'permission:update_users'
        ])->only('edit');
        $this->middleware([
            'permission:delete_users'
        ])->only('destroy');
    }

    // end of constructor
    public function index(Request $request)
    {
        $users = Admin::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })
            ->latest()
            ->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(CreateAdminRequest $request)
    {
        try {
            DB::beginTransaction();

            // validation

            // if (! $request->has('is_active'))
            // $request->request->add([
            // 'is_active' => 0
            // ]);
            // else
            // $request->request->add([
            // 'is_active' => 1
            // ]);

            $fileName = "";
            if ($request->has('photo')) {
                Image::make($request->photo)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                    ->save(public_path('assets/images/users/' . $request->photo->hashName()));

                $image = $request->photo->hashName();
                // $fileName = uploadImage('users', $request->photo);
            }
            // return $request;

            $user = \App\Models\Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $image,
                'password' => bcrypt($request->password)
            ]);
            $user->attachRole('admin');
            $user->syncPermissions($request->permissions);
            DB::commit();
            return redirect()->route('admin.users')->with([
                'success' => 'تم ألاضافة بنجاح'
            ]);
        } catch (\Exception $ex) {
            // DB::rollback();
            return $ex;
            return redirect()->route('admin.users')->with([
                'error' => 'حدث خطا ما برجاء المحاوله لاحقا'
            ]);
        }
    }

    public function edit($id)
    {
        $user = Admin::select()->find($id);
        if (! $user) {
            return redirect()->route('admin.users')->with([
                'error' => 'لا توجد بيانات'
            ]);
        }
        return view('dashboard.users.edit', compact('user'));
    }

    public function update($id, UpdateAdminRequest $request)
    {
        try {
            // validation
            // update DB
            $user = Admin::find($id);
            if (! $user)
                return redirect()->route('admin.users')->with([
                    'error' => 'هذا المستخدم غير موجود'
                ]);
                
//                 if ($request->filled('password')) {
//                     $request->merge(['password' => bcrypt($request->password)]);
//                 }
                
//                 unset($request['id']);
//                 unset($request['password_confirmation']);
                
            DB::beginTransaction();
            if ($request->has('photo')) {
                // $fileName = uploadImage('users', $request->photo);
                Image::make($request->photo)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                    ->save(public_path('assets/images/users/' . $request->photo->hashName()));

                $image = $request->photo->hashName();
                Admin::where('id', $id)->update([
                    'image' => $image
                ]);
            }
            $user->update($request->except('_token', 'id', 'photo', 'permissions'));
            $user->syncPermissions($request->permissions);

            DB::commit();
            return redirect()->route('admin.users')->with([
                'success' => 'تم ألتحديث بنجاح'
            ]);
        } catch (\Exception $ex) {
             return $ex;
            // DB::rollback();
            return redirect()->route('admin.users')->with([
                'error' => 'حدث خطا ما برجاء المحاوله لاحقا'
            ]);
        }
    }

    public function passwordedit($id){
        $user = Admin::select()->find($id);
        if (! $user) {
            return redirect()->route('admin.users')->with([
                'error' => 'لا توجد بيانات'
            ]);
        }
        return view('dashboard.users.editpassword', compact('user'));
    }
    
    public function updatepassword(ProfileRequest $request){
        //validate
        // db
        
        try {
            
            $admin = Admin::find(auth('admin')->user()->id);
            
            
            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }
            
            unset($request['id']);
            unset($request['password_confirmation']);
           // return $request->all();
            $admin->update($request->all());
            
            return redirect()->route('admin.users')->with([
                'success' => 'تم ألتحديث بنجاح'
            ]);
            
        } catch (\Exception $ex) {
            
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
            
        }
    }
    
    public function destroy($id)
    {
        try {
            $admin = Admin::find($id);
            if (! $admin)
                return redirect()->route('admin.users')->with([
                    'error' => 'هذا القسم غير موجود '
                ]);

            // $vendors = $maincategory->vendors();
            // if (isset($vendors) && $vendors->count() > 0) {
            // return redirect()->route('admin.maincategories')->with(['error' => 'لأ يمكن حذف هذا القسم ']);
            // }
            if ($admin->image != 'default.png' || '') {
                $image = Str::after($admin->image, 'assets/');
                $image = base_path('public/assets/images/users/' . $image);
                unlink($image); // delete from folder
            }
            // $admin->categories()->delete();
            $admin->delete();
            return redirect()->route('admin.users')->with([
                'success' => 'تم حذف المستخدم بنجاح'
            ]);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.users')->with([
                'error' => 'حدث خطا ما برجاء المحاوله لاحقا'
            ]);
        }
    }

    public function delete_image($id)
    {
        try {
            $admin = Admin::find($id);
            if (! $admin)
                return redirect()->route('admin.users')->with([
                    'error' => 'هذا القسم غير موجود '
                ]);

            if ($admin->image != 'default.png' || '') {
                $image = Str::after($admin->image, 'assets/');
                $image = base_path('public/assets/images/users/' . $image);
                //return $image;
                unlink($image); // delete from folder
            }
            $image = '';
            Admin::where('id', $id)->update([
                'image' => $image
            ]);
            return redirect()->route('admin.users')->with([
                'success' => 'تم حذف صورة المستخدم بنجاح'
            ]);
        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.users')->with([
                'error' => 'حدث خطا ما برجاء المحاوله لاحقا'
            ]);
        }
    }
}
