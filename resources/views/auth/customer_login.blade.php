@extends('layouts.e_commerce.master')
@section('content')
  <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb" ><a href="home.html">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>My Account</nav><!-- .woocommerce-breadcrumb -->

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article id="post-8" class="hentry">

                                <div class="entry-content">
                                    <div class="woocommerce">
                                        <div class="customer-login-form">
                                            <span class="or-text">or</span>

                                            <div class="col2-set" id="customer_login">

                <div class="col-1">


                    <h2>Login</h2>

                    <form class="login" id="customer_login_form" data-action="{{ route('customer.login.submit') }}">
                   {{ csrf_field() }}
                        <p class="before-login-text">Welcome back! Sign in to your account</p>

                        <p class="form-row form-row-wide">
                            <label for="username">E-mail address or Phone Number<span class="required">*</span></label>
                            <input type="text" class="input-text" name="username" value="" />
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="password">Password<span class="required">*</span></label>
                            <input class="input-text" type="password" name="password" />
                        </p>

                        <p class="form-row">
                           
                            <input type="submit" class="button" name="Login" value="Login" />

                            <label for="rememberme" class="inline"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me</label>
                        </p>

                        <p class="lost_password"><a href="login-and-register.html">Lost your password?</a></p>

                    </form>


                </div><!-- .col-1 -->

                <div class="col-2">

                    <h2>Register</h2>

                    <form method="post" class="register" id="customer_register_form" data-action="{{ route('customer.register') }}">
                       {{ csrf_field() }}

                        <p class="before-register-text">Create your very own account</p>

                        <p class="form-row form-row-wide">
                            <label>Name<span class="required">*</span></label>
                            <input type="text" class="input-text" name="name" value="" />
                        </p>


                        <p class="form-row form-row-wide">
                            <label for="email">Email address<span class="required">*</span></label>
                            <input type="text" class="input-text" name="email" value="" />
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="phone">Phone<span class="required">*</span></label>
                            <input type="text" class="input-text" name="phone" value="" />
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="phone">Password<span class="required">*</span></label>
                            <input type="password" class="input-text" name="password"  value="" />
                        </p>

                        <p class="form-row form-row-wide">
                            <label for="phone">Confirm Password<span class="required">*</span></label>
                            <input type="password" class="input-text" name="password_confirmation" value="" />
                        </p>

                        <p class="form-row"><input type="submit" class="button" name="register" value="Register" /></p>

                       

                    </form>

                </div><!-- .col-2 -->

                                            </div><!-- .col2-set -->

                                        </div><!-- /.customer-login-form -->
                                    </div><!-- .woocommerce -->
                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- .col-full -->
            </div><!-- #content -->
@endsection

@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            //customer register section;
            $('body').on('submit','#customer_register_form',function(e){
                e.preventDefault();
                var formData=new FormData(this);
                $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                     let data=JSON.parse(response);
                        if($.isEmptyObject(data.error)){
                            toastr.success(data.success);
                        }else{
                            toastr.error(data.error[0]);
                        }
                         $('#customer_login_form').trigger("reset");
                       },
                    error:function(response){
                        
                    }
                });
            });

            // customer login section
             $('body').on('submit','#customer_login_form',function(e){
                e.preventDefault();
                var formData=new FormData(this);
                $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                     let data=JSON.parse(response);
                        if($.isEmptyObject(data.error)){
                            toastr.success(data.success);
                            setInterval(function(){
                                 window.location.href = '{{route('ecommerce')}}';
                            },500);
                            
                        }else{
                           if($.isEmptyObject(data.type)){
                             toastr.error(data.error[0]);
                        }else{
                               toastr.error(data.error);
                            }
                        } 
                    },
                    error:function(response){
                        
                    }
            });
            });

        });
           
    </script>
@endpush
@section('content')
    
@endsection
