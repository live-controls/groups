<?php

namespace LiveControls\Groups\Console;

use LiveControls\Groups\Models\UserGroup;
use Illuminate\Console\Command;
use App\Models\User;

class RemoveUserFromGroupCommand extends Command
{
    protected $signature = 'livecontrols:unsetgroup';

    protected $description = 'Removes an user from an usergroup';

    public function handle()
    {
        $id = $this->ask('User ID');
        $groupkey = $this->ask('Group Key');

        $user = User::find($id);
        $group = UserGroup::where('key', '=', $groupkey)->first();

        if(is_null($group)){
            $this->warn('Invalid Group Key!');
            return;
        }
        if(is_null($user)){
            $this->warn('Invalid User ID!');
            return;
        }
        if(!$group->users()->where('users.id', '=', $id)->exists()){
            $this->warn('User is not in group!');
            return;
        }
        
        $group->users()->detach($id);

        $this->info('Removed user from group!');
    }
}