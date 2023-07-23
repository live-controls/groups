<?php

namespace LiveControls\Groups\Traits;

use LiveControls\Groups\Models\UserGroup;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasGroups{
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class, 'livecontrols_user_usergroups', 'user_id', 'user_group_id');
    }

    public function notInGroup(string $key): bool
    {
        foreach($this->groups as $group){
            if($group->key == $key){
                return false;
            }
        }
        return true;
    }

    public function notInOneGroup(array $keys): bool
    {
        foreach($keys as $key){
            if($this->inGroup($key)){
                return false;
            }
        }
        return true;
    }
    
    public function notInGroups(array $keys): bool
    {
        foreach($keys as $key){
            if($this->inGroup($key)){
                return false;
            }
        }
        return true;
    }

    public function inGroup(string $key) : bool
    {
        foreach($this->groups as $group){
            if($group->key == $key){
                return true;
            }
        }
        return false;
    }

    public function inOneGroup(array $keys): bool
    {
        foreach($keys as $key){
            if($this->inGroup($key)){
                return true;
            }
        }
        return false;
    }

    public function inGroups(array $keys): bool
    {
        foreach($keys as $key){
            if(!$this->inGroup($key)){
                return false;
            }
        }
        return true;
    }
}