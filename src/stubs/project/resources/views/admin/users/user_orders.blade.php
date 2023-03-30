@pushonceOnReady('below_js_on_ready')
<script>
    var $ordersCon = $('#users_orders');
    $ordersCon.on('hide.bs.collapse', function () {
        $ordersCon.removeClass('btn-warning');
        $ordersCon.addClass('btn-primary');
    });
    $ordersCon.on('show.bs.collapse', function () {
        $('.js_usersAddonForm.btn-warning').first().click();
        $('#users_orders_btn').removeClass('btn-primary');
        $('#users_orders_btn').addClass('btn-warning');
        $ordersCon.trigger('show_orders');
    });

    var ordersLoader = $ordersCon.html();
    var ordersLoading = false;
    $ordersCon.on('show_orders', function(e, data) {
        if(ordersLoading) return false;
        $ordersCon.html( ordersLoader );
        ordersLoading = true;
        $.ajax({
            url: $ordersCon.attr('data-src'),
            method: 'GET',
            timeout: 0,
            data: data || {},
            dataType: 'html',
            error: function(jqXHR, textStatus, errorThrown){
                if(jqXHR.responseJSON && jqXHR.responseJSON.message) alert(jqXHR.responseJSON.message);
                else alert('Error');
            },
            success: function(response) {
                $ordersCon.html( $(response).filter('#users_orders').first().html() );
                ordersLoading = false;
            }
        });
    });
</script>
@endpushonceOnReady

<div class="card card-body collapse mt-2" id="users_orders"
     data-src="{{route("{$route_namespace}.users.orders", [$chUser])}}">
    <div class="spinner-border spinner-border-sm text-warning" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
