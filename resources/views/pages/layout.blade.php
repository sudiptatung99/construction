<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../" />
    <meta charset="utf-8" />
    <meta name="author" content="Softnio" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Multi-purpose admin dashboard template that especially build for programmers." />
    <title>{{ config('app.name', 'Construction ') }} || @yield('title')</title>  
   <link rel="shortcut icon" href="{{asset('./images/favicon.png')}}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css?v1.1.1') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/style_custom.css') }}" />
    @stack('css') 
</head>

<style>
    p {
        margin: 0;
    }
</style>

<body class="nk-body" data-sidebar-collapse="lg" data-navbar-collapse="lg">
    <!-- Root -->
    <div class="nk-app-root">
        <!-- main  -->
        <div class="nk-main">
            <div class="nk-sidebar nk-sidebar-fixed is-theme" id="sidebar">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a  class="logo-link">
                            <div class="logo-wrap">
                                 <img src="{{asset('./images/maa_tara_builders_logo.png')}}" alt="" style="width: auto; height: 65px;" />
                            </div>
                        </a>
                        <div class="nk-compact-toggle me-n1">
                            <button class="btn btn-md btn-icon text-light btn-no-hover compact-toggle">
                                <em class="icon off ni ni-chevrons-left"></em>
                                <em class="icon on ni ni-chevrons-right"></em>
                            </button>
                        </div>
                        <div class="nk-sidebar-toggle me-n1">
                            <button class="btn btn-md btn-icon text-light btn-no-hover sidebar-toggle">
                                <em class="icon ni ni-arrow-left"></em>
                            </button>
                        </div>
                    </div>
                    <!-- end nk-sidebar-brand -->
                </div>
                <!-- end nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body total_sidebar">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item has-sub">
                                    <a href="{{ url('/dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                                        <span class="nk-menu-text">Home</span>
                                    </a>
                                </li>
                                
                                @php
                                   $parties=\App\Models\Client::first();
                                   
                                @endphp

                                <li class="nk-menu-item">
                                    <a href="{{ isset($parties->id)?url('parties/'.encrypt($parties->id)) :url('/parties') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">
                                            Parties
                                            <em class="icon ni ni-arrow-long-right"></em>
                                        </span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a  class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Category</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/category') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Category List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('category.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Measure Unit</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/unit') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Unit List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('unit.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Unit</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Items</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/items') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Item List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('items.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Item</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--<li class="nk-menu-item has-sub">-->
                                <!--    <a  class="nk-menu-link nk-menu-toggle" style="cursor: pointer">-->
                                <!--        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>-->
                                <!--        <span class="nk-menu-text">Parties</span>-->
                                <!--    </a>-->
                                <!--    <ul class="nk-menu-sub">-->
                                <!--        <li class="nk-menu-item">-->
                                <!--            <a href="{{ url('/client') }}" class="nk-menu-link">-->
                                <!--                <span class="nk-menu-text">Parties List</span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--        <li class="nk-menu-item">-->
                                <!--            <a href="{{ route('client.create') }}" class="nk-menu-link">-->
                                <!--                <span class="nk-menu-text">Add Party</span>-->
                                <!--            </a>-->
                                <!--        </li>-->
                                <!--    </ul>-->
                                <!--</li>-->
                                <li class="nk-menu-item has-sub">
                                    <a  class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Vendors</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/vendors') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Vendors List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('vendors.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Vendor</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Sale</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/sale') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Sale List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('sale.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Sale</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>



                                <li class="nk-menu-item has-sub">
                                    <a  class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Expenses</span>
                                    </a>
                                    <ul class="nk-menu-sub">                                         
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/expense') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Expense List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('expense.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Expense</span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li>

                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Purchase</span>
                                    </a>
                                    <ul class="nk-menu-sub">                                         
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/purchase') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Purchase List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('purchase.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Purchase</span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li>

                                {{-- <li class="nk-menu-item">
                                    <a href="{{ route('purchase.item.view') }}" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">
                                            Purchase Items
                                            <em class="icon ni ni-arrow-long-right"></em>
                                        </span>
                                    </a>
                                </li> --}}

                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Cash & Bank</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                      @php
                                          $bankdetails = \App\Models\Bank::first();
                                      @endphp
                                        <li class="nk-menu-item">
                                            <a href="{{isset($bankdetails->id)? route('bank',encrypt($bankdetails->id)):route('empty-bank')}}" class="nk-menu-link">
                                                <span class="nk-menu-text">Bank Account</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('case')}}" class="nk-menu-link">
                                                <span class="nk-menu-text">Cash in Hand</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nk-menu-item has-sub">
                                    <a style="cursor: pointer" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span> 
                                        <span class="nk-menu-text">Reports</span> 
                                    </a>
                                    <ul class="nk-menu-sub">



                                        <li class="nk-menu-item has-sub">
                                            <a  class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                                <span class="nk-menu-text" >Transaction Report</span>
                                            </a>
                                            <ul class="nk-menu-sub">

                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.sale')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Sale</span>
                                                    </a>
                                                </li>

                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.purchase')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Purchase</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.recive-amount')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Receive Amount</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.advance-amount')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Advance Amount</span>
                                                    </a>
                                                </li>
                                                 <li class="nk-menu-item">
                                                    <a href="{{route('report.expense')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Expenses</span>
                                                    </a>
                                                </li>

                                                <!--<li class="nk-menu-item">-->
                                                <!--    <a href="{{route('report.daybook')}}" class="nk-menu-link">-->
                                                <!--        <span class="nk-menu-text">Day Book</span>-->
                                                <!--    </a>-->
                                                <!--</li>-->

                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.transation')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">All Transaction</span>
                                                    </a>
                                                </li>

                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.profit-loss')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Profit & Loss</span>
                                                    </a>
                                                </li>



                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.bill-profit')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Party Ledger</span>
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.year.profit')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Year wise Profit</span>
                                                    </a>
                                                </li>


                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.balance-sheet')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Balance Sheet</span>
                                                    </a>
                                                </li>
                                                

                                            </ul>
                                        </li>
                                        <li class="nk-menu-item has-sub">
                                            <a  class="nk-menu-link nk-menu-toggle">
                                                <span class="nk-menu-text">Party Report</span>
                                            </a>
                                            <ul class="nk-menu-sub">
                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.parties-profit')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Party wise Profit & Loss</span> 
                                                    </a>
                                                </li>
                                                <li class="nk-menu-item">
                                                    <a href="{{route('report.statement ')}}" class="nk-menu-link">
                                                        <span class="nk-menu-text">Party Statement</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                                {{-- <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle" style="cursor: pointer">
                                        <span class="nk-menu-icon"><em class="icon ni ni-chevron-right-c"></em></span>
                                        <span class="nk-menu-text">Return From Parties</span>
                                    </a>
                                    <ul class="nk-menu-sub">                                         
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/return-parties') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Return Item List</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('return-parties.create') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Add Return Item</span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li> --}}

                            </ul>
                            <!-- .nk-menu -->
                        </div>
                        <!-- .nk-sidebar-menu -->
                    </div>
                    <!-- .nk-sidebar-content -->
                </div>
                <!-- .nk-sidebar-element -->
            </div>
            <!-- .nki-sidebar -->
            <!-- sidebar @e -->
            <!-- wrap -->
            <div class="nk-wrap client_datafull">
                <!-- include Header  -->
                <div class="nk-header nk-header-fixed">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-header-logo ms-n1">
                                <div class="nk-sidebar-toggle">
                                    <button class="btn btn-sm btn-icon btn-zoom sidebar-toggle d-sm-none">
                                        <em class="icon ni ni-menu"></em>
                                    </button>
                                    <button
                                        class="btn btn-md btn-icon btn-zoom sidebar-toggle d-none d-sm-inline-flex">
                                        <em class="icon ni ni-menu"></em>
                                    </button>
                                </div>
                                <div class="nk-navbar-toggle me-2">
                                    <button class="btn btn-sm btn-icon btn-zoom navbar-toggle d-sm-none">
                                        <em class="icon ni ni-menu-right"></em>
                                    </button>
                                    <button class="btn btn-md btn-icon btn-zoom navbar-toggle d-none d-sm-inline-flex">
                                        <em class="icon ni ni-menu-right"></em>
                                    </button>
                                </div>
                                <a href="./html/index.html" class="logo-link">
                                    <div class="logo-wrap">
                                        <img class="logo-img logo-light" src="./images/logo.png"
                                            srcset="./images/logo2x.png 2x" alt />
                                        <img class="logo-img logo-dark" src="./images/logo-dark.png"
                                            srcset="./images/logo-dark2x.png 2x" alt />
                                        <img class="logo-img logo-icon" src="./images/logo-icon.png"
                                            srcset="./images/logo-icon2x.png 2x" alt />
                                    </div>
                                </a>
                            </div>
                            <nav class="nk-header-menu nk-navbar top_btn">
                                <ul class="nk-nav">
                                    <li class="nk-nav-item has-sub add_btn_head">
                                        <a href="{{route('sale.create')}}" class="nk-nav-link">
                                            <em class="icon ni ni-plus-circle-fill"></em>
                                            &nbsp;
                                            <span class="nk-nav-text">Add Sale</span>
                                        </a>
                                    </li>
                                    <li class="nk-nav-item has-sub add_btn_head_blue">
                                        <a href="{{route('purchase.create')}}" class="nk-nav-link">
                                            <em class="icon ni ni-plus-circle-fill"></em>

                                            &nbsp;
                                            <span class="nk-nav-text">Add Purchase</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav ms-2">
                                    <li class="dropdown">
                                        <a  data-bs-toggle="dropdown">
                                            <div class="d-sm-none">
                                                <div class="media media-md media-circle">
                                                    <img src="https://w7.pngwing.com/pngs/981/645/png-transparent-default-profile-united-states-computer-icons-desktop-free-high-quality-person-icon-miscellaneous-silhouette-symbol-thumbnail.png" alt class="img-thumbnail" />
                                                </div>
                                            </div>
                                            <div class="d-none d-sm-block"> 
                                                <div class="media media-circle">
                                                    <img src="https://w7.pngwing.com/pngs/981/645/png-transparent-default-profile-united-states-computer-icons-desktop-free-high-quality-person-icon-miscellaneous-silhouette-symbol-thumbnail.png" alt class="img-thumbnail" />
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md">
                                            <div
                                                class="dropdown-content dropdown-content-x-lg py-3 border-bottom border-light">
                                                <div class="media-group">
                                                    <div class="media media-xl media-middle media-circle">
                                                        <img src="https://w7.pngwing.com/pngs/981/645/png-transparent-default-profile-united-states-computer-icons-desktop-free-high-quality-person-icon-miscellaneous-silhouette-symbol-thumbnail.png" alt class="img-thumbnail" />
                                                    </div>
                                                    <div class="media-text">
                                                        <div class="lead-text">{{ Auth::user()->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="dropdown-content dropdown-content-x-lg py-3 border-bottom border-light">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="{{route('profile.edit')}}"><em
                                                                class="icon ni ni-user"></em>
                                                            <span>Profile</span></a>
                                                    </li>

                                                    <li>
                                                        <a href="{{route('change-pass')}}"><em
                                                                class="icon ni ni-setting-alt"></em>
                                                            <span>Password</span></a> 
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-content dropdown-content-x-lg py-3">
                                                <ul class="link-list">
                                                    <li>
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <a href="route('logout')"
                                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"><em
                                                                    class="icon ni ni-signout"></em>
                                                                <span>Log Out</span></a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- .nk-header-tools -->
                        </div>
                        <!-- .nk-header-wrap -->
                    </div>
                    <!-- .container-fliud -->
                </div>
                <!-- header -->
                <!-- content -->
                <div class="nk-content">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .nk-content -->
                <!-- include Footer -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Designed and developed by <a target="_blank" 
                                    href="https://www.dignexus.com/">Dignexus</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- .nk-footer -->
            </div>
            <!-- .nk-wrap -->
        </div>
        <!-- .nk-main -->
    </div>
    <!-- .nk-app-root -->
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                            "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                                .valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>
<!-- JavaScript -->
<script src="{{ asset('/assets/js/bundle.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.js') }}"></script>
<div class="offcanvas offcanvas-end offcanvas-size-lg" id="notificationOffcanvas">
    <div class="offcanvas-header border-bottom border-light">
        <h5 class="offcanvas-title" id="offcanvasTopLabel">
            Recent Notification
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" data-simplebar>
        <ul class="nk-schedule">
            <li class="nk-schedule-item">
                <div class="nk-schedule-item-inner">
                    <div class="nk-schedule-symbol active"></div>
                    <div class="nk-schedule-content">
                        <span class="smaller">2:12 PM</span>
                        <div class="h6">Added 3 New Images</div>
                        <ul class="d-flex flex-wrap gap g-2 py-2">
                            <li>
                                <div class="media media-xxl">
                                    <img src="./images/product/a.jpg" alt class="img-thumbnail" />
                                </div>
                            </li>
                            <li>
                                <div class="media media-xxl">
                                    <img src="./images/product/b.jpg" alt class="img-thumbnail" />
                                </div>
                            </li>
                            <li>
                                <div class="media media-xxl">
                                    <img src="./images/product/c.jpg" alt class="img-thumbnail" />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nk-schedule-item">
                <div class="nk-schedule-item-inner">
                    <div class="nk-schedule-symbol active"></div>
                    <div class="nk-schedule-content">
                        <span class="smaller">4:23 PM</span>
                        <div class="h6">Invitation for creative designs pattern</div>
                    </div>
                </div>
            </li>
            <li class="nk-schedule-item">
                <div class="nk-schedule-item-inner">
                    <div class="nk-schedule-symbol active"></div>
                    <div class="nk-schedule-content nk-schedule-content-no-border">
                        <span class="smaller">10:30 PM</span>
                        <div class="h6">Task report - uploaded weekly reports</div>
                        <div class="list-group-dotted mt-3">
                            <div class="list-group-wrap">
                                <div class="p-3">
                                    <div class="media-group">
                                        <div class="media rounded-0">
                                            <img src="./images/icon/file-type-pdf.svg" alt />
                                        </div>
                                        <div class="media-text ms-1">
                                            <a  class="title">Modern Designs Pattern</a>
                                            <span class="text smaller">1.6.mb</span>
                                        </div>
                                    </div>
                                    <!-- .media-group -->
                                </div>
                                <div class="p-3">
                                    <div class="media-group">
                                        <div class="media rounded-0">
                                            <img src="./images/icon/file-type-doc.svg" alt />
                                        </div>
                                        <div class="media-text ms-1">
                                            <a  class="title">Cpanel Upload Guidelines</a>
                                            <span class="text smaller">18kb</span>
                                        </div>
                                    </div>
                                    <!-- .media-group -->
                                </div>
                                <div class="p-3">
                                    <div class="media-group">
                                        <div class="media rounded-0">
                                            <img src="./images/icon/file-type-code.svg" alt />
                                        </div>
                                        <div class="media-text ms-1">
                                            <a  class="title">Weekly Finance Reports</a>
                                            <span class="text smaller">10mb</span>
                                        </div>
                                    </div>
                                    <!-- .media-group -->
                                </div>
                            </div>
                        </div>
                        <!-- .list-group-dotted -->
                    </div>
                </div>
            </li>
            <li class="nk-schedule-item">
                <div class="nk-schedule-item-inner">
                    <div class="nk-schedule-symbol active"></div>
                    <div class="nk-schedule-content">
                        <span class="smaller">3:23 PM</span>
                        <div class="h6">Assigned you to new database design project</div>
                    </div>
                </div>
            </li>
            <li class="nk-schedule-item">
                <div class="nk-schedule-item-inner">
                    <div class="nk-schedule-symbol active"></div>
                    <div class="nk-schedule-content nk-schedule-content-no-border flex-grow-1">
                        <span class="smaller">5:05 PM</span>
                        <div class="h6">You have received a new order</div>
                        <div class="alert alert-info mt-2" role="alert">
                            <div class="d-flex">
                                <em class="icon icon-lg ni ni-file-code opacity-75"></em>
                                <div class="ms-2 d-flex flex-wrap flex-grow-1 justify-content-between">
                                    <div>
                                        <h6 class="alert-heading mb-0">
                                            Business Template - UI/UX design
                                        </h6>
                                        <span class="smaller">Shared information with your team to
                                            understand and
                                            contribute to your project.</span>
                                    </div>
                                    <div class="d-block mt-1">
                                        <a  class="btn btn-md btn-info"><em
                                                class="icon ni ni-download"></em><span>Download</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .alert -->
                    </div>
                </div>
            </li>
            <li class="nk-schedule-item">
                <div class="nk-schedule-item-inner">
                    <div class="nk-schedule-symbol active"></div>
                    <div class="nk-schedule-content">
                        <span class="smaller">2:45 PM</span>
                        <div class="h6">Project status updated successfully</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<script src="{{ asset('/assets/js/charts/analytics-chart.js') }}"></script>
<script src="{{ asset('/assets/js/data-tables/data-tables.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
<!-- <script src="./assets/js/charts/chart-example.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
@stack('js');
<script>
    function showDiv() {
        document.getElementById('more-data').style.display = "block";
    }
</script>
@stack('js')




</html>
