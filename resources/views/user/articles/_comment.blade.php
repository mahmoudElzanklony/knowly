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
<hr>
