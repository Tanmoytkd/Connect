<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name'
    ];

    public static function getSection($sectionName) {
        $role = Role::where('role_name', $sectionName);
        if($role->count()==0) {
            $role = new Role();
            $role->role_name = $sectionName;
            $role->save();
        }
        return $role;
    }
}
