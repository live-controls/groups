<?php

namespace LiveControls\Groups\Scripts;

use Exception;
use Illuminate\Support\Collection;
use LiveControls\Groups\Models\UserGroup;

class UserGroupHandler{
    /**
     * Adds a single UserGroup to the database
     *
     * @param string $key The key of the UserGroup to be used in traits etc.
     * @param string|null $name The name of the UserGroup, would be uppercase first of $key if nothing is set
     * @param string|null $color The color of the UserGroup as hex
     * @param string|null $description The description of the UserGroup
     * @return UserGroup|null
     */
    public static function add(string $key, ?string $name = null, ?string $color = null, ?string $description = null): UserGroup|null
    {
        return UserGroup::create([
            'key' => $key,
            'name' => is_null($name) ? ucfirst($key) : $name,
            'color' => $color,
            'description' => $description
        ]);
    }

    /**
     * Creates a group of UserGroups
     *
     * @param array $groups The UserGroups as array ['key' => '', 'name' => '', 'color' => '', 'description' => '']
     * @return Collection
     */
    public static function create(array $groups): Collection
    {
        $col = collect();
        foreach($groups as $group)
        {
            $key = '';
            $name = '';
            $color = '';
            $description = '';
            if(is_string($group)){
                $key = $group;
                $name = ucfirst($key);
                $color = null;
                $description = null;
            }else{
                $key = $group["key"];
                $name = array_key_exists("name", $group) ? $group["name"] : ucfirst($key);
                $color = array_key_exists("color", $group) ? $group["color"] : null;
                $description = array_key_exists("description", $group) ? $group["description"] : null;
            }
            $newGroup = static::add($key, $name, $color, $description);

            $col->add($newGroup);
        }
        return $col;
    }

    public static function edit(string $key, ?string $name = null, ?string $color = null, ?string $description = null)
    {
        if(!static::exists($key)){
            throw new Exception("UserGroup with key '".$key."' does not exist!");
        }
        static::remove($key);
        static::add($key, $name, $color, $description);
    }

    /**
     * Removes a single UserGroup
     *
     * @param string $key The key of the usergroup
     * @return boolean
     */
    public static function remove(string $key): bool
    {
        if(!static::exists($key)){
            throw new Exception("UserGroup with key '".$key."' does not exist!");
        }
        return UserGroup::where('key', '=', $key)->delete();
    }

    /**
     * Truncates the whole UserGroup table.
     * DANGEROUS!
     *
     * @return int Deleted Items
     */
    public static function clear():int
    {
        $count = 0;
        foreach(UserGroup::all() as $ug){
            $ug->delete();
            $count++;
        }
        return $count;
    }

    /**
     * Checks if a UserGroup with a certain key exists
     *
     * @param string $key
     * @return boolean
     */
    public static function exists(string $key): bool
    {
        return UserGroup::where('key', '=', $key)->exists();
    }

    /**
     * Returns the color
     *
     * @param string $key
     * @return string
     */
    public static function color(string $key, bool $darkmode = false): string
    {
        if(!static::exists($key)){
            throw new Exception("UserGroup with key '".$key."' does not exist!");
        }
        $group = UserGroup::where('key', '=', $key);
        return $darkmode && !is_null($group->darkmode_color) ? $group->darkmode_color : $group->color;
    }
}
