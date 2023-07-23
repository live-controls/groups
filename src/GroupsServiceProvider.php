<?php

namespace LiveControls\Groups;

use Helvetiapps\LiveControls\Console\UserGroups\AddUserGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\AddUserToGroupCommand;
use Helvetiapps\LiveControls\Console\UserGroups\RemoveUserFromGroupCommand;
use Helvetiapps\LiveControls\Http\Middleware\UserGroups\CheckUserGroup;
use Illuminate\Support\ServiceProvider;

class LiveControlsServiceProvider extends ServiceProvider
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
      ]);
      
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('livecontrols_groups.php'),
      ], 'livecontrols.groups.config');
    }
  }
}
