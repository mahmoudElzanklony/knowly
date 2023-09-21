@foreach($articles as $article)
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

                <div class="mb-3 tx-14 limited-text">{!! $article->body !!}</div>
            </div>
{{--            @if($article->file)
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
                            <span class="badge badge-success mx-2">{{$article->views}} <i class="icon-md"
                                                                                          data-feather="eye"></i></span>
                        @endif
                    </div>
                </div>


                <div class="input-group mb-3 d-none" id="form-{{$article->id}}">
                    <input type="text" class="form-control" name="comment"
                           id="input-{{$article->id}}" placeholder="Add comment"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"
                                onclick="comment({{$article->id}})">Comment
                        </button>
                    </div>
                </div>
                <div id="comment-container-{{$article->id}}">

                </div>
{{--                @php
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

