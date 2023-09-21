<!DOCTYPE html>
<html>
<head>
    <title>{{__('dashboard.project_name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('logo.png') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <!-- end plugin css -->

    @stack('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/')}}" class="sidebar-dark">

<script src="{{ asset('assets/js/spinner.js') }}"></script>

<div class="main-wrapper" id="app">
    @include('layout.sidebar')
    <div class="page-wrapper">
        @include('layout.header')
        <div class="page-content">
            @yield('content')
        </div>
        @include('layout.footer')
    </div>
</div>

<!-- base js -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- end common js -->
{{-- Display errors --}}
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
<script>
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1113000
        });
        @if(Session::has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ Session::get('success') }}'
        });
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        Toast.fire({
            icon: 'error',
            title: '{{ $error }}'
        });
        @endforeach
        @endif
        {{-- alert confirm delete then submit form --}}
        $('.delete-form').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '{{__('dashboard.are_you_sure')}}',
                text: '{{__('dashboard.revet_it')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('dashboard.delete')}}'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
        $('.approve-form').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '{{__('dashboard.are_you_sure')}}',
                text: '{{__('dashboard.cant_change_again')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('dashboard.approve_it') }}'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
        $('.decline-form').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '{{__('dashboard.are_you_sure')}}',
                text: '{{__('dashboard.cant_change_again')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('dashboard.decline_it') }}'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });

    })
</script>
@stack('custom-scripts')
</body>
</html>
