<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Crud com Laravel</title>
</head>
<body>
  <div class="container">
    @yield('create-product')
  </div>
  <div class="container">
    @yield('list-product')
  </div>
</body>
</html>
    
