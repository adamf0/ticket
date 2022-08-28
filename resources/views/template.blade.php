<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/icon?family=Material+Icons"
        />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <link rel="stylesheet" href="<?php echo asset('custom.css'); ?>" />

        <title>Hello, world!</title>
    </head>
    <body>
        <div id="mySidebar" class="sidebar">
            <x-side-bar></x-side-bar>
        </div>

        <!-- main content page -->

        <div id="main">
            <x-top-content></x-top-content>
            @section('content')
            @show
        </div>

        <script>
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
