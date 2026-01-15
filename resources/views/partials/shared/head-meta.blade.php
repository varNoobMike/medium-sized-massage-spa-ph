<meta charset="UTF-8">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'My Web App')</title>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.13.1/bootstrap-icons.min.css') }}">

<!-- Google Font: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

<!-- Bootswatch: Flatly -->
<link href="{{ asset('assets/bootswatch/flatly/bootstrap.min.css') }}" rel="stylesheet">

<!-- Shared Custom CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shared.css') }}">