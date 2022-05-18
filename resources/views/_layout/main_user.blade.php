<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @yield('title-user')
    @yield('styles-user')
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark pt-3" style="background: -webkit-linear-gradient(0deg, #014282 30%, #014282 30%);">
            <div class="container">
                @if (!Auth::guest())
                    <a class="navbar-brand" href="{{route('user.index')}}">LMS</a>
                @else
                    <a class="navbar-brand" href="{{url('/')}}">LMS</a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link active" data-toggle="dropdown" href="#">{{Auth::user()->name}}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('user.profile.show', Auth::user()->username)}}" class="dropdown-item">Profil</a>

                                <a href="{{route('auth.logout')}}" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>
    </header>
    <section class="mt-5">
        @yield('content-user')
    </section>
    <!-- Footer -->
    <footer class="fdb-block footer-large" style="padding-bottom: 0px!important; border-top: 1px solid #dee2e6;margin-top: 100px;">
        <div class="container">
          <div class="row align-items-top text-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-sm-left">
              <nav class="nav flex-column">
              </nav>
            </div>
          </div>
        </div>
        <div class="row mt-3" style="background-color: #f0f0f0; border-top: 1px solid #dee2e6!important; padding: 20px; margin-bottom: 0px;">
          <div class="col text-center" style="color: #3d3d3d;">
            Faishal Hanin creation
          </div>
        </div>
</footer>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @yield('scripts-user')
</html>
