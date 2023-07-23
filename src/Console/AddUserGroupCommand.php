<?php

namespace LiveControls\Groups\Console;

use LiveControls\Groups\Models\UserGroup;
use Illuminate\Console\Command;

class AddUserGroupCommand extends Command
{
    protected $signature = 'livecontrols:addgroup';

    protected $description = 'Adds a new UserGroup to the database';

    public function handle()
    {
        $this->info("Please enter the informations for the new group.");
        $name = $this->ask('Name');
        while($name == null || $name == ''){
            $this->warn('Group name is required!');
            $name = $this->ask('Name');
        }
        $key = $this->ask('Key');
        if(UserGroup::where('key', '=', $key)->exists()){
            $key = null;
        }
        while($key == null || $key == ''){
            $this->warn('Group key is required and needs to be unique!');
            $key = $this->ask('Key');
        }
        $desc = $this->ask('Description (Optional)');

        $this->info('');
        $this->info('------------------------------------');
        $this->info('');
        $this->info('Name: '.$name);
        $this->info('Key: '.$key);
        $this->info('Description: '.$desc);
        if($this->confirm("Are those informations correct?")){
            $group = UserGroup::create([
                'name' => $name,
                'key' => $key,
                'description' => $desc
            ]);
    
            if(is_null($group)){
                $this->warn('Couldnt create User Group!');
                return;
            }
            $this->info('User Group created!');
        }
    }
}