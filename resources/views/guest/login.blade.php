@extends('layouts.guest.app')

@section('title', 'Login - Rose Massage Services')


@section('content')
<nav aria-label="breadcrumb" class="mb-md-5 mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="" class="nav-link">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Login
        </li>
    </ol>
</nav>



<div class="row justify-content-center align-items-center">

    <div class="col-md-5">

        <div class="card shadow-sm border-0 rounded-3">

            <div class="card-body p-4">

                <h1 class="text-center mb-4">Login</h1>

                <form action="{{ route('login.store') }}" method="POST">

                    @csrf

                    @if (session('auth_error'))
                        <div class="alert alert-danger rounded-3 mb-4">
                            {{ session('auth_error') }}
                        </div>
                    @endif


                    <div class="mb-4">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control rounded-3  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password">
                        @error('password')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary rounded-3 w-100">Login</button>

                </form>

            </div>
        </div>
    </div>

</div>

@endsection