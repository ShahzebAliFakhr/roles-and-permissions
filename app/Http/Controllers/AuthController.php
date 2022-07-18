<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    // After Login Submit 
    public function login(Request $request){
        if(Auth::attempt(['phone' => $request->input('phone'), 'password' => $request->input('password')])){
            return redirect('dashboard');
        }else{
            $data['class'] = 'danger';
            $data['message'] = 'Invalid Credentials';
            return redirect('/')->with($data);
        }
    }

    // After Regsiter Submit
    public function register(Request $request){
        $controls = $request->all();
        $rules = [
            'name'      => 'required|max:100',
            'email'     => 'required|unique:users',
            'phone'     => 'required|max:11|min:11|unique:users',
            'password'  => 'required|max:50|min:6',
        ];

        $validator = Validator::make($controls, $rules);

        if($validator->fails()){
            return redirect("register")->withErrors($validator)->withInput();
        }else{
            $result = User::create([
                'name'              => $request->input('name'),
                'email'             => $request->input('email'),
                'phone'             => $request->input('phone'),
                'password'          => Hash::make($request->input('password')),
                'role_id'           => $request->input('role_id')
            ]);
            if($result){
                $data['class'] = 'success';
                $data['message'] = 'Account Created! Please login to continue';
                return redirect('/')->with($data);
            }else{
                $data['class'] = 'danger';
                $data['message'] = 'Something went wrong while creating your account. Please tryagain later.';
                return redirect('register')->with($data);
            }
        }
    }

    // Profile
    public function profile(){
        $data['roles'] = Role::get()->toArray();
        $data['profile'] = User::find(Auth::id());
        return view('profile', $data);
    }

    // Profile Update
    public function profile_update(Request $request){
        $controls = $request->all();
        $rules = [
            'name'      => 'required|max:100',
            'image'     => 'image|mimes:jpg,png,jpeg|max:2048'
        ];

        $validator = Validator::make($controls, $rules);

        if($validator->fails()){
            return redirect(url()->previous())->withErrors($validator)->withInput();
        }else{

            $user = [
                'name'      => $request->input('name')
            ];

            if($request->has('password') && $request->input('password') != NULL){
                $user['password']   = Hash::make($request->input('password'));
            }

            if($request->has('email') && $request->input('email') != NULL){
                $user['email']   = $request->input('email');
            }

            if($request->hasFile('image')){
                $file               = $request->file('image');
                $path               = 'uploads/user-photos/';
                $filename           = rand(000000000, 999999999) . '_' . $file->getClientOriginalName();
                $uploading          = $file->move($path, $filename);
                $user['image']  = $path . $filename;
            }else{
                $user['image'] = $request->input('image_old');
            }

            $result = User::where('id', Auth::id())->update($user);

            if($result){
                $data["message"] = "Profile Updated Successfully!";
                $data["class"] = "success";
            }else{
                $data["message"] = "Some Error Occured while updating the record!";
                $data["class"] = "danger";
            }

            return redirect('profile')->with($data);
        }
    }

    // Dashboard
    public function dashboard(Request $request){
        return view('dashboard');
    }

    // loginAsUser
    public function loginAsUser($id){
        $user = User::where('role_id', $id)->get()->first();
        Auth::loginUsingId($user->id);
        return redirect('/');
    }
}
