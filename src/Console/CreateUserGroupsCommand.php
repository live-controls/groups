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
        $deletedCount = UserGroupHandler::clear();
        $this->info($deletedCount." UserGroups deleted");
        $this->info("Reading configuration file");
        $groups = config('livecontrols_groups.usergroups_to_generate', []);
        $this->info("Generating UserGroups");
        $ugCol = UserGroupHandler::create($groups);
        $this->info(count($ugCol)." UserGroups generated!");
    }
}
