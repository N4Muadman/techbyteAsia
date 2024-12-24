<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('loginAssets/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('loginAssets/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('loginAssets/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('loginAssets/css/style.css') }}">

    <title>Login</title>
  </head>
  <body>



  <div class="content d-flex align-items-center" style="height: 100vh">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="/loginAssets/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In to <strong>TechByteAsia Admin</strong></h3>
            </div>
            <form action="{{ route('login') }}" method="post">
                @csrf
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              @error('loginError')
                  <p class="text-danger">{{ $message }}</p>
              @enderror

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                {{-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> --}}
              </div>

              <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
            </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


    <script src="{{ asset('loginAssets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('loginAssets/js/popper.min.js') }}"></script>
    <script src="{{ asset('loginAssets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('loginAssets/js/main.js') }}"></script>
  </body>
</html>
