# Colibri admin

Admin module for Colibri based applications

## Features
* [AdminLte](https://github.com/almasaeed2010/AdminLTE) interface.
* Extensible throw Events entry points.
* Dashboard with sortable widgets.
* Users manager using [dektium/user](https://github.com/dektrium/yii2-user).
* Rbac manager using [dektrium/rbac](https://github.com/dektrium/yii2-rbac).
* Settings manager using [pheme/settings](https://github.com/phemellc/yii2-settings).

## Installation

Run the following command to install :
```bash
composer require colibri-platform/admin
```

## Configuration

Add following lines to your main configuration file:

```php
'modules' => [
    'admin' => [
        'class' => 'colibri\admin\Module',
    ],
],
'bootstrap' => [
    'admin'
]
```