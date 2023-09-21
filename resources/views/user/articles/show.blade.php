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
                                            <p>{{$article->user->name}}</p>
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
                                <div class="d-flex post-actions mb-3">
                                    <a href="javascript:;" onclick="showCommentForm('form-{{$article->id}}')"
                                       class="d-flex align-items-center text-muted mr-4">
                                        <i class="icon-md" data-feather="message-square"></i>
                                        <p class="d-none d-md-block ml-2">
                                            Comment
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
                                           aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="false">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"
                                                onclick="comment({{$article->id}})">Comment
                                        </button>
                                    </div>
                                </div>
                                <div id="comment-container-{{$article->id}}">

                                </div>
                                @php
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
