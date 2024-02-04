<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8"> 
    <title>{{ env('APP_NAME') }} || Forgot Password</title> 
    <link rel="shortcut icon" href="{{asset('./images/favicon.png')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">  
</head>  
<body class="nk-body" data-sidebar-collapse="lg" data-navbar-collapse="lg">
    <div class="nk-app-root">
        <div class="nk-main">
            <div class="nk-wrap align-items-center justify-content-center">
                <div class="container p-2 p-sm-4">
                    <div class="wide-xs mx-auto">
                        <div class="text-center mb-5">
                            <div class="brand-logo mb-1">
                                <a href="{{ url('/') }}" class="logo-link">
                                    <div class="logo-wrap">
                                        <img src="{{asset('./images/maa_tara_builders_logo.png')}}" alt="" style="width: auto; height: 65px;" />
                                    </div> 
                                </a>
                            </div>
                          
                        </div> 
                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1">Forgot Password</h3> 
                                        <p class="small">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="text-danger h6 text-center" />  
                                <form method="POST" action="{{ route('password.email') }}"> 
                                @csrf  
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" name="email" :value="old('email')" required>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-12">
                                            <div class="d-grid"><button class="btn btn-primary" type="submit">Email Password Reset Link</button></div>
                                        </div>
                                    </div>
                                </form>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script> 
</html> 



