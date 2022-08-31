<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset('custom.css'); ?>">

    <title>Login - Aplikasi Help Desk IT</title>
  </head>
  <body>
    <div class="image-login">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="card card-login m-5 h-100">
              <div class="card-body my-4">
                <h2 class="text-center text-white my-4">Help Desk IT</h2>
                <form action="{{ route('dologin') }}" method="post" class="mx-4">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-white">Username</label>
                    <input type="text" name="username" class="form-control form-custom" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text-white">Password</label>
                    <input type="password" name="password" class="form-control form-custom" id="exampleInputPassword1" required>
                  </div>
                  <br><br>
                  <button type="submit" class="btn btn-red w-100">Submit</button>
                </form>
              </div>
            </div>
          </div>
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
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function(){
      setTimeout(function(){
          $('.toast').removeClass('show');
      },2500);
    });
  </script>
</html>