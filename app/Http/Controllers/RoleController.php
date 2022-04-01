<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $data['roles'] = Role::orderBy('created_at', 'desc')->get()->toArray();
        return view('roles', $data);
    }

    public function save(Request $request){
        try{    
            $result = Role::create([
                'name'          => strtoupper($request->input('name')),
                'status'        => $request->input('status')
            ]);
            if($result){
                $data['class'] = 'success';
                $data['message'] = 'Role Created Successfully!';
            }else{
                $data['class'] = 'danger';
                $data['message'] = 'Something went wrong while creating the record.';
            }
        }catch (Exception $e) {
            $data["message"] = "Error: ". $e->getMessage();
            $data["class"] = "danger";
        }
        return redirect('roles')->with($data);
    }

    public function update(Request $request){
        try{
            $result = Role::where('id', $request->input('id'))->update([
                'name'          => strtoupper($request->input('name')),
                'status'        => $request->input('status')
            ]);
            if($result){
                $data['class'] = 'success';
                $data['message'] = 'Role Updated Successfully!';
            }else{
                $data['class'] = 'danger';
                $data['message'] = 'Something went wrong while updating the record.';
            }
        }catch (Exception $e) {
            $data["message"] = "Error: ". $e->getMessage();
            $data["class"] = "danger";
        }
        return redirect('roles')->with($data);
    }

    public function delete($id){
        try{
            $result = Role::where('id', $id)->whereNot('id', 1)->delete();
            if($result){
                $data['class'] = 'success';
                $data['message'] = 'Role Deleted Successfully!';
            }else{
                $data['class'] = 'danger';
                $data['message'] = 'Something went wrong while deleting the record.';
            }
        }catch (Exception $e) {
            $data["message"] = "Error: ". $e->getMessage();
            $data["class"] = "danger";
        }
        return redirect('roles')->with($data);
    }

    public function permissions($id){
        $data['role'] = Role::find($id);
        if($data['role']->permissions != 'null' && $data['role']->permissions){
            $data['permissions'] = json_decode($data['role']->permissions);
        }else{
            $data['permissions'] = [];
        }
        if($data['role']){
            return view('role-permissions', $data);
        }else{
            $data['class'] = 'danger';
            $data['message'] = 'Something went wrong while showing the record.';
            return redirect('roles')->with($data);
        }
    }

    public function permissions_update(Request $request){
        try{
            $result = Role::find($request->input('id'))->update([
                'permissions'   => json_encode($request->input('permissions'))
            ]);
            if($result){
                $data['class'] = 'success';
                $data['message'] = 'Role Deleted Successfully!';
            }else{
                $data['class'] = 'danger';
                $data['message'] = 'Something went wrong while updating the record.';
            }
        }catch (Exception $e) {
            $data["message"] = "Error: ". $e->getMessage();
            $data["class"] = "danger";
        }
        return redirect('roles')->with($data);
    }
}
