<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UsersOrdersController extends Controller {
    public function __construct() {
        if(!request()->route()) return;

        $this->table = Cart::getModel()->getTable();
        $this->routeNamespace = Str::before(request()->route()->getName(), '.users');
        View::composer('admin/users/*', function($view)  {
            $viewData = [
                'route_namespace' => $this->routeNamespace,
            ];
            // @HOOK_VIEW_COMPOSERS
            $view->with($viewData);
        });
        // @HOOK_CONSTRUCT
    }

    public function orders(User $chUser) {
        $viewData = [];
        $viewData['chUser'] = $chUser;
        $viewData['statuses'] = Cart::$statuses;
        $bldQry = Cart::select($this->table.".*")
            ->with(['addresses', 'payment.payment', 'delivery.delivery'])
            ->where( function($qry) use ($chUser) {
                $qry->where('user_id', $chUser->id)
                    ->orWhereHas('addresses', function($qry2) use ($chUser) {
                        $qry2->where('type', 'factura')
                            ->where('email', $chUser->email);
                    });
            })
            ->where('status', '!=', null)
            ->where('status', '!=', 'processing')
            ->where($this->table.".site_id", app()->make('Site')->id)
            ->orderBy($this->table.".confirmed_at", 'DESC');

        // @HOOK_ORDERS

        $viewData['orders'] = $bldQry->get();

        return view('admin/users/user_orders_table', $viewData);
    }
}
