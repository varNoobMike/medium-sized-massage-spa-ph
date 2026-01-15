@extends('layouts.non-panel.app')

@section('title', 'Register as Therapist - Rose Massage Services')

@section('content')
<div class="row justify-content-center align-items-center">

    <div class="col-md-5">

        {{-- Card --}}
        <div class="card shadow-sm border-0 rounded-3">

            <div class="card-body p-4">

                <h3 class="text-center mb-4">Register</h3>

                {{-- Form --}}
                <form action="{{ route('register.therapist.submit') }}" method="POST">

                    @csrf  

                    
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center mb-4">
                            <i class="bi bi-x-circle me-2"></i>
                            {{ $errors->first() }}                     
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

                    {{-- Username --}}
                    <div class="mb-4">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control rounded-3  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name')
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

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password_confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary rounded-3 w-100">Register</button>

                </form>

            </div>
        </div>
    </div>

</div>
@endsection