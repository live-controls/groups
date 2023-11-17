<?php

namespace LiveControls\Groups\Console;

use Illuminate\Console\Command;
use LiveControls\Groups\Scripts\UserGroupHandler;

class CreateUserGroupsCommand extends Command
{
    protected $signature = 'livecontrols:creategroups';

    protected $description = 'Creates the usergroups from the configuration file';

    public function handle()
    {
        $this->info("Deletes all usergroups");
        UserGroupHandler::clear();
        $this->info("UserGroups deleted");
        $this->info("Reading configuration file");
        $groups = config('livecontrols.usergroups_to_generate', []);
        $this->info("Generating UserGroups");
        UserGroupHandler::create($groups);
        $this->info("UserGroups generated!");
    }
}