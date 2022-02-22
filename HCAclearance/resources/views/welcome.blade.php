<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Login Form | CodingLab</title> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>


    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <form class="user" action="{{route('login')}}" method=" ">
            @csrf
          <div class="row form-group">
            <i class="fas fa-user"></i>
            <input type="text"  placeholder="Email or Phone" required name="username">
          </div>
          <div class="row form-group">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" required name="password">
          </div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <h4 id="wrapper-bottom"><center>MATS College of Technology</center></h4>
        </form>

      </div>
    </div>


    <script>
    $('document').ready(function(){
        @if($errors->any())
            $("#alert").fadeIn(500).delay(3000).fadeOut(500);
        @endif
    })

  </script>

  </body>
</html>
