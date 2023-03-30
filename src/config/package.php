<?php
	return [
		'install' => [
            'php artisan db:seed --class="\Marinar\UsersOrders\Database\Seeders\MarinarUsersOrdersInstallSeeder"',
		],
		'remove' => [
            'php artisan db:seed --class="\Marinar\UsersOrders\Database\Seeders\MarinarUsersOrdersRemoveSeeder"',
        ]
	];
