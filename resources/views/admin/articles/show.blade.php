@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"
          rel="stylesheet"/>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('articles.index')}}">Researches</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('dashboard.view')}}</li>
        </ol>
    </nav>
    <div class="profile-page tx-13">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img class="img-xs rounded-circle"
                                             src="{{ url('https://via.placeholder.com/37x37') }}" alt="">
                                        <div class="ml-2">
                                            <p>{{auth()->user()->name}}</p>
                                            <p class="tx-11 text-muted">{{$article->created_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="overflow:auto;">
                                <div class="mb-4">
                                    <h3 class="pl-0">
                                        {{ $article->title }}
                                    </h3>
                                    {{-- display tags --}}
                                    @foreach($article->tags as $tag)
                                        <span class="badge badge-primary">{{ $tag->tag }}</span>
                                    @endforeach
                                </div>

                                <div class="mb-3 tx-14">{!! $article->body !!}</div>
                            </div>
                            @if($article->articleFiles()->count() > 0)
                                <div class="card-footer">
                                    @foreach($article->articleFiles as $index => $file)
                                        {{-- download file --}}
                                        <a href="{{ route('articles.download_file', $file->id) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="fa fa-download"></i> Download File {{ $index + 1 }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <div class="card-footer">
                                @foreach($article->comments as $comment)
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="img-xs rounded-circle"
                                                 src="{{ url('https://via.placeholder.com/37x37') }}" alt="">
                                            <div class="ml-2">
                                                <p>{{$comment->user->name}}</p>
                                                <p class="tx-11 text-muted">{{$comment->created_at->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                        <form action="{{route('admin.comments.destroy',$comment)}}" method="post" class="d-inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon d-inline-block">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="p-2" style="overflow:auto;">
                                        <div class="tx-14">{{ $comment->body }}</div>
                                    </div>
                                    {{-- check if last loop --}}
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce.js') }}"></script>
@endpush
