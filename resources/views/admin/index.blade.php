<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    World Connect
                </div>

                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }} " role = "alert">{{ Session::get('alert-' . $msg) }} 
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                      @endif
                    @endforeach
                </div>

                <form method="POST" action="/login" class="form-group">
                	{{ csrf_field() }}
                	<input type="text" name="email" class="form-control">
                	<input type="password" name="password" class="form-control">
                	<button>Нэвтрэх</button>
                </form>
            </div>
        </div>
    </body>
</html>