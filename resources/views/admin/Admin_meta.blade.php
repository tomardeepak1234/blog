<!DOCTYPE html>
<html lang="en">
@include('Admin.header')
<body>
    @include('Admin.navbar')

    @include('Admin.sidebar')
    @yield('content')
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
