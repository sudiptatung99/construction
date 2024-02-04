<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maa Tara Construction</title>
    <link rel="shortcut icon" href="{{asset('./images/favicon.png')}}" />
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Prata&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/fonts/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
</head>

<body>
    <div class="py-1 top-wrap px-3 px-md-0">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md topper d-flex align-items-xl-center">
                    <div class="text">
                        <p class="con"><span>Free Call:</span> <span>+1 234 456 78910</span></p>
                    </div>
                </div>
                <div class="col-md topper d-flex justify-content-lg-end">
                    <div class="text me-4 d-flex align-items-center justify-content-lg-end">
                        <p class="con"><span>Email Adddress:</span> <span><a href=""
                                    class="">youremail@gmail.com</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- navbar start --}}
    <nav class="navbar navbar-expand-lg  ftco-navbar-light">
        <div class="container-xl">
            <a class="navbar-brand aside-stretch align-items-center" href="/">
               <img src="{{asset('./images/maa_tara_builders_logo.png')}}" alt="" style="width: 100px;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="hero-wrap" style="background-image: url('{{asset("user/images/bg_1.jpg")}}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center text-center">
                <div class="col-lg-9">
                    <div class="text" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                        <span class="subheading">Since 1982</span>
                        <h1 class="mb-5">We Will Be <span>Happy</span> To Take Care Of Your Work</h1>
                        <p><a href="#" class="btn btn-primary p-4 py-3">Contact us <span
                                    class="ion-ios-arrow-round-forward"></span></a> <a href="#"
                                class="btn btn-darken p-4 py-3">Request A
                                Quote <span class="ion-ios-arrow-round-forward"></span></a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('user.about')
    @include('user.services')
    @include('user.contact')

    <footer class="ftco-footer">
        <div class="container-xl">
            <div class="row mb-5 pb-5 justify-content-between">
                <div class="col-md-6 col-lg">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 logo d-flex">
                            <a class="navbar-brand align-items-center" href="/">
                                <img src="{{asset('./images/maa_tara_builders_logo.png')}}" alt="" style="width: 100px;" />
                            </a>
                        </h2>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                        <ul class="ftco-footer-social list-unstyled mt-2">
                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fab fa-facebook"></span></a></li>
                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-2">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Quick Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right me-2"></span>Home</a></li>
                            <li><a href="#about"><span class="fa fa-chevron-right me-2"></span>About</a></li>
                            <li><a href="#services"><span class="fa fa-chevron-right me-2"></span>Services</a></li>
                            <li><a href="#contact"><span class="fa fa-chevron-right me-2"></span>Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fas fa-map-marker-alt"></span><span class="text">203 Fake St.
                                        Mountain View, San
                                        Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon fas fa-phone-alt"></span><span
                                            class="text">+2
                                            392 3929 210</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span
                                            class="text"><span>youremail@gmail.com</span></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 py-5 bg-darken">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mb-0" style="color: rgba(255,255,255,.5); font-size: 13px;">Copyright &copy;
                            <script data-cfasync="false" src=""></script>
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('user/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('user/js/aos.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>

</body>

</html>
