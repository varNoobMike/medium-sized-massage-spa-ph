@extends('layouts.auth.app')

@section('title', 'Login - Rose Massage Services')

@section('breadcrumb')

@foreach ( $breadcrumbs as $crumb)

@if ($crumb['url'])
<li class="breadcrumb-item">
    <a href="{{ $crumb['url'] }}" class="text-dark">{{ $crumb['title'] }}</a>
</li>
@else
<li class="breadcrumb-item">
    {{ $crumb['title'] }}
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


                    {{-- Error alert --}}
                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        {{ $errors->first() }}
                    </div>
                    {{-- Alert after redirecting to this page --}}
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
                    <button type="submit" class="btn btn-primary rounded-3 w-100">Login</button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection