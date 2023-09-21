@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 pr-md-0">
                            <div class="auth-left-wrapper" style="
                            background-image: url({{ asset('logo.png') }});
                            background-size: contain;
                            background-repeat: no-repeat;
                            background-position: center;
                            ">

                            </div>
                        </div>
                        <div class="col-md-6 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Research<span>App</span></a>
                                <h5 class="text-muted font-weight-normal mb-4">Create account.</h5>
                                {{-- Display Erros --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ __($error) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="forms-sample" action="{{route('register')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" autocomplete="Name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" autocomplete="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">RePassword</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" autocomplete="password_confirmation" placeholder="Password Confirmation">
                                    </div>
                                    {{-- select user or owner  --}}
                                    <div class="form-group">
                                        <label for="type">Register As</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="user">User</option>
                                            <option value="owner">Company</option>
                                        </select>
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Register</button>
                                    </div>
                                    <a href="{{route('login')}}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
