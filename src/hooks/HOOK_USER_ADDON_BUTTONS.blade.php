@if(isset($chUser) && $authUser->can('view', \App\Models\Cart::class))
    <button class="btn btn-primary mr-2 js_usersAddonForm"
            data-toggle="collapse"
            id="users_orders_btn"
            data-target="#users_orders"
            type="button"
            role="button"
            aria-expanded="false"
            aria-controls="users_orders">@lang('admin/users/user_orders.button')</button>
@endif
