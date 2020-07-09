<style>
    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #171d26;
        border-color: #171d26;
    }
</style>
<div class="list-group">
   <a href="{{route('customer.dashboard.index')}}" class="list-group-item list-group-item-action"><i class="fa fatachometer-alt"></i>DASHBOARD</a>
   <a href="{{ route('customer.orders.index') }}" class="list-group-item list-group-item-action"><i class="fa fashopping-cart"></i>MY ORDERS</a>
   <a href="{{ route('customer.profile.index') }}" class="list-group-item list-group-item-action"><i class="fa fauser-circle"></i>MY PROFILE</a>
</div>