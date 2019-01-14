<header>
    <div class="nav_container nav_head">
        <div class="nav_box">
            <div class="nav_cons">
                <a href="{{ route('index') }}">
                    <img class="fs_logo" alt="" src="frontend/images/fs-logo.svg?TODO">
                </a>
                <nav class="nav_menu">
                    <ul>
                        @foreach ($headerLinks['header'] as $item)
                            <li><a href="{{$item['url']}}"> {{$item['name']}} </a></li>
                        @endforeach
                    </ul>
                </nav>
                <div class="nav_tools">
                    <a href="{{ url('/cart') }}" class="nav_tools_cart">
                        <i class="icon-cart"></i>
                        <span class="cart_count" id="cartNum"> {{ $cartNum >= 100 ? '99+' : $cartNum }} </span>
                    </a>
                    @guest
                        <a class="nav_account" href="{{ route('account.login', ['returnUrl'=> $returnUrl]) }}">
                            <i class="icon-user"></i> <span>{{__('cart_sign_in')}}</span>
                        </a>
                        <a class="nav_join_free" href="{{ route('account.register', ['returnUrl'=> $returnUrl]) }}">
                            <button class="c-btn">{{__('common_join_free')}}</button>
                        </a>
                    @else
                        <div class="nav_account">
                            <a href="{{ url('/member') }}">
                                <i class="icon-user"></i>
                                <span>{{ __('common_hi') }}, {{ Auth::user()->display_name }}</span>
                                <i class="icon-angle-down"></i>
                            </a>
                            <ul class="nav_pop_content">
                                <li><a href="/member">{{__('common_my_account')}}</a>
                                </li>
                                <li><a href="/member/orders">{{__('member_my_order')}}</a>
                                </li>
                                <li><a href="{{route('account.logout')}}">{{__('common_sign_out')}}</a>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>
