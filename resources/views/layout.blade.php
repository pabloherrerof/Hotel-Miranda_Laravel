<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
     <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
  />
  <link rel="stylesheet" href="../styles/styles.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
@include('header')
  @yield('content')
@include('footer')
</body>
@yield('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($message = Session::get('error'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{$message}}',
    confirmButtonColor: '#222222'
  })
</script>
@endif
@if ($message = Session::get('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Thank You!',
    text: '{{$message}}',
    confirmButtonColor: '#222222'
  })
</script>
@endif
</html>