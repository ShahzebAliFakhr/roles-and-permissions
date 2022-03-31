<?php

use App\Models\Role;

function checkPermissionbyRoleID($id, $permission){
    $permissions = json_decode(Role::find($id)->permissions);
    if($permissions){
        if(in_array($permission, $permissions)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

?>