@extends('layouts.non-panel.app')
@section('title', 'Login - Rose Massage Services')


@section('content')


<div class="col-md-5 mx-auto">

        {{-- Card --}}
        <div class="card shadow-sm rounded-3">

            <div class="card-body p-4">

                <h3 class="text-center mb-4">Login</h3>

                {{-- Form --}}
                <form action="{{ route('login.submit') }}" method="POST">

                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                            <i class="bi bi-x-circle"></i>
                            {{ $errors->first() }}                     
                        </div>
                    
                    @elseif(session('logout_success'))
                        <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ session('logout_success') }}
                        </div>

                    @elseif(session('register_success'))
                        <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i>
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


@endsection