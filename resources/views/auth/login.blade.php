@extends('layouts.auth.app')

@section('title', 'Login - Rose Massage Services')

@section('breadcrumb')

@foreach ( $breadcrumbs as $crumb)

@if ($crumb['url'])
<li class="breadcrumb-item">
    <a href="{{ $crumb['url'] }}">
        <span class="small">
            {{ $crumb['title'] }}
        </span>
    </a>
</li>
@else
<li class="breadcrumb-item active" aria-current="page">
    <span class="small">
        {{ $crumb['title'] }}
    </span>
</li>
@endif

@endforeach

@endsection

@section('content')

<div class="row justify-content-center align-items-center">

    <div class="col-md-5">

        {{-- Card --}}
        <div class="card shadow-sm border-0 rounded-3">

            <div class="card-body p-4">

                <h1 class="text-center mb-4">Login</h1>

                {{-- Form --}}
                <form action="{{ route('login.submit') }}" method="POST">

                    @csrf


                    @if ($errors->has('login_error'))
                        <div class="alert alert-danger d-flex align-items-center text-danger mb-4">
                            <i class="bi bi-x-circle me-2"></i>
                            {{ $errors->first('login_error') }}                     
                        </div>
                    
                    @elseif(session('logout_success'))
                        <div class="alert alert-success rounded-3 mb-4">
                            {{ session('logout_success') }}
                        </div>

                    @elseif(session('register_success'))
                        <div class="alert alert-success rounded-3 mb-4">
                            {{ session('register_success') }}
                        </div>
                    @endif


                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control rounded-3  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password">
                        @error('password')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-dark rounded-3 w-100">Login</button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection