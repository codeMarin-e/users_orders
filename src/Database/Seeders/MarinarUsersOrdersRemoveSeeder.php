<?php
    namespace Marinar\UsersOrders\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\UsersOrders\MarinarUsersOrders;
    use Spatie\Permission\Models\Permission;

    class MarinarUsersOrdersRemoveSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public static function configure() {
            static::$packageName = 'marinar_users_orders';
            static::$packageDir = MarinarUsersOrders::getPackageMainDir();
        }

        public function run() {
            if(!in_array(env('APP_ENV'), ['dev', 'local'])) return;

            $this->autoRemove();

            $this->refComponents->info("Done!");
        }
    }
