<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name'
    ];

    public static function getSection($roleName) {
        $role = Role::where('role_name', $roleName);
        if($role->count()==0) {
            $role = new Role();
            $role->role_name = $roleName;
            $role->save();
        } else {
            $role = $role->first();
        }
        return $role;
    }
}
