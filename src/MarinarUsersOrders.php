<?php
namespace Marinar\UsersOrders;

use Marinar\UsersOrders\Database\Seeders\MarinarUsersOrdersInstallSeeder;

class MarinarUsersOrders {

    public static function getPackageMainDir() {
        return __DIR__;
    }

    public static function injects() {
        return MarinarUsersOrdersInstallSeeder::class;
    }
}
