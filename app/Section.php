<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'parent_id',
        'section_type',
        'completion_status',
        'section_image_path',
        'logo_path',
        'name'
    ];

    public function getLogoPath() {
        $sec = $this;
        $logo = $sec->logo_path;
        while($logo==null) {
            $sec = $sec->getParent();
            $logo = $sec->logo_path;
        }
        return $logo;
    }

    public function getCoverPath() {
        $sec = $this;
        $coverPic = $sec->section_image_path;
        while($coverPic==null) {
            $sec = $sec->getParent();
            $coverPic = $sec->section_image_path;
        }
        return $coverPic;
    }

    public function subscribers() {
        return $this->belongsToMany('App\User', 'subscriptions', 'section_id', 'subscriber_id');
    }


    public function posts() {
        return $this->hasMany('App\Post', 'section_id', 'id');
    }

    public function getPublicPosts() {
        return $this->posts()->latest()->where('privacy_level', 'public')->get();
    }

    public function memberships() {
        return $this->hasMany('App\Membership', 'section_id', 'id');
    }

    public function isProject() {
        return ($this->parent_id) == 0 && ($this->section_type=='project');
    }

    public function isUserSection() {
        return ($this->parent_id==0) && ($this->section_type=='user');
    }

    public function isChildSection() {
        return ($this->parent_id != 0) && ($this->section_type == 'section');
    }

    public function parent() {
        return $this->belongsTo('App\Section', 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany('App\Section', 'parent_id', 'id');
    }

    public function getParent() {
        return Section::findOrFail($this->parent_id);
    }

    public function childSections() {
        return $this->hasMany('App\Section', 'parent_id', 'id');
    }

    public function requests() {
        return $this->hasMany('App\Request', 'section_id', 'id');
    }
}
