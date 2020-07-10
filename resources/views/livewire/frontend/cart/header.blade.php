<div>
    <li class="nav-item ml-3 mr-3">
        <a href="{{ route('frontend.cart.index') }}" class="btn btn-md shadow btn-outline-dark btn-block" style="color: #333;background-color: #fff;border-color: #fff;"><i class="fa fa-shopping-cart"></i> {{ $cartTotal }} | {{ money_id($cartTotalPrice) }}</a>
    </li>
</div>
