<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
public function editAdmin($id)
{
    $admin = User::findOrFail($id);
    return view('profile.edit', compact('admin'));
}

public function updateAdmin(Request $request, $id)
{

    $request->validate([
        'last_name' => 'required|string|max:255',
        'first_name' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'grade' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',

    ]);
 $user = User::findOrFail($id);

    if ($user->role === 'superadmin') {
        return back()->with('error', 'You cannot edit the Super Admin.');
    }
    $admin = User::findOrFail($id);
    $admin->update($request->only([
        'last_name',
        'first_name',
        'email',
        'phone',
        'grade',
        'country',
    ]));

    return redirect()->route('adminList')->with('success', 'Admin updated successfully.');

        if($request->hasFile('image')){
            //delete old image
            $oldImageName = $request->oldImage;
            if($request->oldImage != null){
                if(file_exists(public_path('adminProfile/'.$request->oldImage))){
                    unlink(public_path('adminProfile/'.$request->oldImage));
                }
            }
            //upload new image
            $fileName = uniqid() . $request->file('image')->getUserOriginalName();
            $request->file('image')->move(public_path(). '/Profile/' , $fileName);
            $adminData['profile'] = $fileName;
        }
        else{
            $adminData['profile']= $request->oldImage;
        }


        // dd($adminData);
        User::where('id',Auth::user()->id)->update($adminData);
        Alert::success('Update Success', 'Profile Updated Successfully....');
        return back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');


    }


      //profile details
    public function profileDetails(){
           return view('profile.details');
    }

    //create admin account
    public function createAdminAccount(){
        return view('profile.add_admin');
    }

    //create new admin account
    public function create(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'grade' => 'required',
            'country' => 'required',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password'
        ]);
        $adminAccount = [
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'grade' => $request->grade,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider' => 'simple'
        ];

            User::create($adminAccount);
            Alert::success('Success', 'New Admin Account Created Successfully....');
            return back();
    }


    //profile update
    //    dd($request->all()) ;

    //direct account Profile
    public function accountProfile($id){
        $account = User::where('id',$id)->first();
        return view('profile.accountProfile',compact('account'));
    }


    //request admin data
    private function requestAdminData($request){

        // dd($request->all()) ;
        $data =[];
        if(Auth::user()->name != null){
            $data['last_name'] =Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        }else{
            $data['first_name'] =Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        }

        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] =$request->phone;
        $data['grade'] =$request->grade;
        $data['country'] =$request->country;

        return $data;
    }

      //create | update validation check
      private function validationCheck($request){
        $rules = [
            'phone' => ['required', 'unique:users,phone,' . Auth::user()->id],
            'country' => 'required',
        ];


        if (Auth::user()->provider == 'simple') {
            $rules['last_name'] = 'required';
            $rules['email'] = 'required|unique:users,email,' . Auth::user()->id;
        }

        $validator = $request->validate($rules);

    }
}


