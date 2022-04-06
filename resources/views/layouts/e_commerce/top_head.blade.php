<div class="top-bar hidden-md-down">
    <div class="container">
        <nav>
            <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                <li class="menu-item animate-dropdown"><a title="Welcome to Worldwide Electronics Store" href="#">Welcome to Estran Technology Store</a></li>
            </ul>
        </nav>

        <nav>
            <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                @if (Session::get('CustomerSession') !="")
                    <li class="menu-item animate-dropdown">
                              <a title="Shop" href="" onclick="event.preventDefault();
                                document.getElementById('customer-logout-form').submit();"><i class="fa fa-sign-in"></i>Logout</a>
                             <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                      <li class="menu-item animate-dropdown"><a title="My Account" href="#"><i class="ec ec-user"></i>{{Session::get('CustomerSession')->name}}</a></li>
                      @else
                       <li class="menu-item animate-dropdown"><a title="Shop" href="{{ route('customer.login') }}"><i class="fa fa-sign-in"></i>Login</a></li>
                @endif
                       

              
              
                  
               
            </ul>
        </nav>
    </div>
</div><!-- /.top-bar -->