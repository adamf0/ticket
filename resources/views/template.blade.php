<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo asset('custom.css'); ?>" />

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

        <title>Aplikasi Help Desk IT</title>
    </head>
    <body>
        <div id="mySidebar" class="sidebar">
            <x-side-bar></x-side-bar>
        </div>

        @if( Session::has('type_modal') && Session::has('message') )
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header <?php echo (Session::get('type_modal')=="success" ? "bg-success":"bg-danger")?>">
                            <strong class="me-auto text-white">Notifikasi</strong>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
                        </div>
                        <div class="toast-body">
                            {{ Session::get('message') }}
                        </div>
                    </div>
                </div>
                @php
                    Session::forget('type_modal');
                    Session::forget('message');
                @endphp
            @endif
        <!-- main content page -->

        <div id="main">
            <x-top-content></x-top-content>
            @section('content')
            @show
        </div>

        <script>
            $(document).ready(function(){
                setTimeout(function(){
                    $('.toast').removeClass('show');
                },2500);
            });
            function openNav() {
                if(document.getElementById("mySidebar").style.width == "300px"){
                    document.getElementById("mySidebar").style.width = "0";
                }else{
                    document.getElementById("mySidebar").style.width = "300px";
                }
                if(document.getElementById("main").style.marginLeft == "300px"){
                    document.getElementById("main").style.marginLeft = "0"
                }else{
                    document.getElementById("main").style.marginLeft = "300px"
                }
            }
        </script>
    </body>
</html>
