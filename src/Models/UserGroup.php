<?php

namespace LiveControls\Groups\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use LiveControls\Permissions\Models\UserPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserGroup extends Model{
    use HasFactory;

    protected $table = 'livecontrols_user_groups';
    
    protected $fillable = [
        'name',
        'key',
        'description',
        'color',
        'darkmode_color'
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'livecontrols_user_usergroups', 'user_group_id', 'user_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(UserPermission::class, 'livecontrols_group_userpermissions', 'user_group_id', 'user_permission_id');
    }
}