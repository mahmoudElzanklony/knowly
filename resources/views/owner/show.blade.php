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

        .limited-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@endpush

@section('content')
    <div class="profile-page tx-13">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="profile-header">
                    <div class="cover">
                        <div class="gray-shade"></div>
                        <figure>
                            <img src="{{ url('https://via.placeholder.com/1148x272') }}" class="img-fluid"
                                 alt="profile cover">
                        </figure>
                        <div class="cover-body d-flex justify-content-between align-items-center">
                            <div>
                                <img class="profile-pic" src="{{ url('https://via.placeholder.com/100x100') }}"
                                     alt="profile">
                                <span class="profile-name">{{$user->name}}</span>
                            </div>
                            {{--                            <div class="d-none d-md-block">--}}
                            {{--                                <button class="btn btn-primary btn-icon-text btn-edit-profile">--}}
                            {{--                                    <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile--}}
                            {{--                                </button>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div class="header-links">
                        <ul class="links d-flex align-items-center mt-3 mt-md-0">
                            {{--                           <li class="header-link-item d-flex align-items-center active">
                                                           <i class="mr-1 icon-md" data-feather="columns"></i>
                                                           <a class="pt-1px d-none d-md-block" href="#">Timeline</a>
                                                       </li>
                                                       <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                                           <i class="mr-1 icon-md" data-feather="user"></i>
                                                           <a class="pt-1px d-none d-md-block" href="#">About</a>
                                                       </li>
                                                       <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                                           <i class="mr-1 icon-md" data-feather="users"></i>
                                                           <a class="pt-1px d-none d-md-block" href="#">Friends <span class="text-muted tx-12">3,765</span></a>
                                                       </li>
                                                       <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                                           <i class="mr-1 icon-md" data-feather="image"></i>
                                                           <a class="pt-1px d-none d-md-block" href="#">Photos</a>
                                                       </li>
                                                       <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                                                           <i class="mr-1 icon-md" data-feather="video"></i>
                                                           <a class="pt-1px d-none d-md-block" href="#">Videos</a>
                                                       </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        @if(!is_null($user->bio))
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="card-title mb-0">BIO</h6>
                            </div>
                            <p>{{$user->bio}}</p>
                        @endif
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Joined:</label>
                            <p class="text-muted">{{ $user->created_at->format('F d, Y') }}</p>
                        </div>
                        @if(!is_null($user->website))
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Website:</label>
                                <p class="text-muted"><a href="{{$user->website}}" class="text-muted">{{$user->website}}</a></p>
                            </div>
                        @endif
{{--                        <div class="mt-3 d-flex social-links">--}}
{{--                            <a href="javascript:;"--}}
{{--                               class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon github">--}}
{{--                                <i data-feather="github" data-toggle="tooltip" title="github.com/nobleui"></i>--}}
{{--                            </a>--}}
{{--                            <a href="javascript:;"--}}
{{--                               class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">--}}
{{--                                <i data-feather="twitter" data-toggle="tooltip" title="twitter.com/nobleui"></i>--}}
{{--                            </a>--}}
{{--                            <a href="javascript:;"--}}
{{--                               class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">--}}
{{--                                <i data-feather="instagram" data-toggle="tooltip" title="instagram.com/nobleui"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-6 middle-wrapper">
                <div class="row">
                    @foreach($articles as $article)
                        <div class="col-md-12 grid-margin">
                            <div class="card rounded">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('user.articles.index' , ['user_id' => $article->user->id])}}"
                                           class="d-flex align-items-cente text-black">
                                            <img class="img-xs rounded-circle"
                                                 src="{{ url('https://via.placeholder.com/37x37') }}" alt="">
                                            <div class="ml-2">
                                                <p>{{$article->user->name}}</p>
                                                <p class="tx-11 text-muted">{{$article->created_at->diffForHumans()}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body" style="overflow:auto;">
                                    <div class="mb-4">
                                        <h3 class="pl-0">
                                            {{ $article->title }}
                                        </h3>
                                        @foreach($article->tags as $tag)
                                            <span class="badge badge-primary">{{ $tag->tag }}</span>
                                        @endforeach
                                    </div>

                                    <div class="mb-3 tx-14 limited-text">{!! $article->body !!}</div>
                                </div>
                                {{--                                @if($article->file)
                                                                    <div class="card-footer">
                                                                        <a href="{{ route('articles.download_file', $article->id) }}"
                                                                           class="btn btn-success btn-sm">
                                                                            <i class="fa fa-download"></i> Download File
                                                                        </a>
                                                                    </div>
                                                                @endif--}}
                                <div class="card-footer">
                                    <div class="d-flex post-actions mb-3">
                                        @if(auth()->check())
                                            <a href="javascript:;" onclick="showCommentForm('form-{{$article->id}}')"
                                               class="d-flex align-items-center text-muted mr-4">
                                                <i class="icon-md" data-feather="message-square"></i>
                                                <p class="d-none d-md-block ml-2">
                                                    Comment
                                                </p>
                                            </a>
                                        @endif
                                        <a href="{{route('user.articles.show', $article)}}" target="_blank"
                                           class="d-flex align-items-center text-muted mr-4">
                                            <i class="icon-md" data-feather="eye"></i>
                                            <p class="d-none d-md-block ml-2">
                                                View
                                            </p>
                                        </a>
                                        <div class="float-right">
                                            @if($article->comments()->count() > 0)
                                                <span class="badge badge-secondary mx-2">{{$article->comments()->count()}} <i
                                                        class="icon-md" data-feather="message-square"></i></span>
                                            @endif
                                            @if($article->articleFiles()->count() > 0)
                                                <span class="badge badge-light mx-2">{{$article->articleFiles()->count()}} <i
                                                        class="icon-md" data-feather="file"></i></span>
                                            @endif
                                            @if($article->views > 0)
                                                <span class="badge badge-success mx-2">{{$article->views}} <i
                                                        class="icon-md" data-feather="eye"></i></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="input-group mb-3 d-none" id="form-{{$article->id}}">
                                        <input type="text" class="form-control" name="comment"
                                               id="input-{{$article->id}}" placeholder="Add comment"
                                               aria-label="Recipient's username" aria-describedby="basic-addon2"
                                               autocomplete="false">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"
                                                    onclick="comment({{$article->id}})">Comment
                                            </button>
                                        </div>
                                    </div>
                                    <div id="comment-container-{{$article->id}}">

                                    </div>
                                    {{--                              @php
                                                                        $comments = $article->comments()->orderBy('created_at', 'desc')->get();
                                                                        // $total_comments = $article->comments()->count();
                                                                        @endphp
                                                                        @foreach($comments as $comment)
                                                                            <div class="d-flex align-items-center justify-content-between">
                                                                                <div class="d-flex align-items-center">
                                                                                    <img class="img-xs rounded-circle"
                                                                                         src="{{ url('https://via.placeholder.com/37x37') }}" alt="">
                                                                                    <div class="ml-2">
                                                                                        <p>{{$comment->user->name}}</p>
                                                                                        <p class="tx-11 text-muted">{{$comment->created_at->diffForHumans()}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="p-2" style="overflow:auto;">
                                                                                <div class="tx-14">{{ $comment->body }}</div>
                                                                            </div>
                                                                            @if(!$loop->last)
                                                                                <hr>
                                                                            @endif
                                                                        @endforeach--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="article_container">

                    </div>
                    <div class="col-md-12 grid-margin" style="display: none" id="load_more_div">
                        <div class="card rounded">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    No More Articles
                                </div>
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
    <script>
        function showCommentForm(id) {
            $('#' + id).toggleClass('d-none');
        }

        function comment(id) {
            let comment = $('#input-' + id).val();
            // check if comment is empty
            if (comment === '') {
                return;
            }
            $.ajax({
                url: '{{ route('user.articles.comment') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    article_id: id,
                    comment: comment
                },
                success: function (response) {
                    $('input[name=comment]').val('');
                    $('#comment-container-' + id).append(response);
                }
            });
        }
    </script>
@endpush
