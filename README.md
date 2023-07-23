# Groups
 ![Release Version](https://img.shields.io/github/v/release/live-controls/groups)
 ![Packagist Version](https://img.shields.io/packagist/v/live-controls/groups?color=%23007500)
 
 Add groups to your users
 

## Requirements
- Laravel 8.0+
- PHP 8.0+
- LiveControls\Permissions (Will be automatically included if not installed already)


## Translations
None


## Installation
```
composer require live-controls/groups
```

## Setup
#### Set administrator groups (default is group with key 'admin')
1) Run in console:
```
php artisan vendor:publish --tag="livecontrols.groups.config"
```
2) Open /config/livecontrols_groups.php
3) Change line "usergroups_admins" to an array of UserGroup keys

## Usage
Todo
