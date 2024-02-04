<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8"> 
    <title>{{ env('APP_NAME') }} || Reset Password</title>
    <link rel="shortcut icon" href="https://zemez.io/html/wp-content/uploads/sites/9/2018/01/logo.png">  
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
                                        <img src="https://zemez.io/html/wp-content/uploads/sites/9/2018/01/logo.png" alt="">
                                    </div> 
                                </a>
                            </div>
                            <p>{{ env('APP_NAME') }}</p> 
                        </div>
                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1">Reset Password</h3>
                                        <p class="small">Please sign-in to your account and start the adventure.</p>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="text-danger h6 text-center" />  
                                <x-input-error :messages="$errors->get('password')" class="text-danger h6 text-center" />   
                                <form method="POST" action="{{ route('password.store') }}">  
                                @csrf  
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}"> 
                                    <div class="row gy-3">   
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <div class="form-control-wrap">
                                                    <input type="password" class="form-control" name="password" required> 
                                                </div> 
                                            </div>
                                        </div> 
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Confirm Password</label> 
                                                <div class="form-control-wrap"> 
                                                    <input type="password" class="form-control" name="password_confirmation" required> 
                                                </div>  
                                            </div> 
                                        </div>  
                                        <div class="col-12">
                                            <div class="d-grid"><button class="btn btn-primary" type="submit">Reset Password</button></div>
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

