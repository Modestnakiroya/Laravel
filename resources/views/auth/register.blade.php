@extends('layouts.app', ['activePage' => 'register', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION'])

@section('content')
<div class="full-page section-image" data-color="blue" data-image="{{ asset('image/1.jpeg') }}">
    <div class="content pt-5">
        <div class="container mt-5">
            <div class="col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card card-register">
                        <div class="card-header text-center">
                            <h3 class="header">{{ __('Create Account') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label">{{ __('Password Confirmation') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label d-flex align-items-center">
                                        <input class="form-check-input" name="agree" type="checkbox" required>
                                        <span class="form-check-sign"></span>
                                        <b>{{ __('Agree with terms and conditions') }}</b>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Create Account') }}</button>
                            </div>
                            <div class="text-center mt-3">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Already have an account? Login') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col mt-3">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();

        gsap.from('.card', {duration: 1, y: 50, opacity: 0, ease: 'power3.out'});

        $('.form-control').on('focus', function() {
            $(this).parent().addClass('input-group-focus');
        }).on('blur', function() {
            $(this).parent().removeClass('input-group-focus');
        });
    });
</script>
@endpush

@push('css')
<style>
    .full-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
    }
    .card-register {
        border: none;
        border-radius: 10px;
        box-shadow: 0 15px 35px rgba(50,50,93,.1),0 5px 15px rgba(0,0,0,.07);
    }
    .card-header {
        background-color: transparent;
        border-bottom: none;
        padding: 30px 0 15px;
    }
    .form-control {
        border-radius: 25px;
        padding: 10px 20px;
    }
    .btn-primary {
        border-radius: 25px;
        padding: 12px 20px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50,50,93,.1), 0 3px 6px rgba(0,0,0,.08);
    }
    .btn-link {
        color: #3498db;
        font-weight: 600;
    }
    .form-check-label {
        color: #555;
    }
    .alert {
        border-radius: 10px;
    }
</style>
@endpush