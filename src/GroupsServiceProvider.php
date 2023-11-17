<?php

namespace LiveControls\Groups;

use LiveControls\Groups\Console\AddUserGroupCommand;
use LiveControls\Groups\Console\AddUserToGroupCommand;
use LiveControls\Groups\Console\RemoveUserFromGroupCommand;
use LiveControls\Groups\Http\Middleware\CheckUserGroup;
use Illuminate\Support\ServiceProvider;
use LiveControls\Groups\Console\CreateUserGroupsCommand;

class GroupsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //Add Middlewares
    app('router')->aliasMiddleware('usergroup', CheckUserGroup::class);

    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'livecontrols_groups');
  }

  public function boot()
  {
    $migrationsPath = __DIR__.'/../database/migrations/';
    $migrationPaths = [
      $migrationsPath.'usergroups',
    ];
    
    $this->loadMigrationsFrom($migrationPaths);

    if ($this->app->runningInConsole())
    {
      $this->commands([
        AddUserGroupCommand::class,
        AddUserToGroupCommand::class,
        RemoveUserFromGroupCommand::class,
        CreateUserGroupsCommand::class,
      ]);
      
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('livecontrols_groups.php'),
      ], 'livecontrols.groups.config');
    }
  }
}
