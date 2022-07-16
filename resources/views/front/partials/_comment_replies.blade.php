@foreach ($comments as $comment)
<div class="w-100 display-comment">
    <div style="min-height: 100px">
        <div class="author-thumb">
            <img src="https://i.pravatar.cc/80?id={{$comment->author->id}}" class="rounded" alt="">
        </div>
        <div class="right-content h-100">
            <h4>{{$comment->author->name}}<span>{{$comment->created_at->format("F
                    j, Y, g:i a")}}</span></h4>
            <p>{{$comment->body}}</p>
        </div>
    </div>
    <div style="margin-bottom: 30px;
    padding-bottom: 15px !important;border-bottom:1px solid #eee !important;">
        <button style="margin-left: 100px;cursor:pointer;font-size: 12px !important" data-toggle="modal"
            data-target="#commentReply{{$comment->id}}"
            class="rounded bg-primary text-white border border-primary px-3 py-1 reply-btn">Reply</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="commentReply{{$comment->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">
                        Reply to: <span class="text-primary">{{$comment->author->name}}</span>
                    </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-0 submit-comment">
                        @auth
                        <div class="content">
                            <form id="comment" action="{{route('reply.store', ['post' => $post->slug])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <x-form.textarea name="body" placeholder="Type your comment" />
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" style="cursor:pointer">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @else
                        <p>Please <a href="{{route('login')}}">LOGIN</a> or
                            <a href="{{route('register')}}">REGISTER</a>
                            to write a
                            comment.
                        </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.partials._comment_replies', ['comments' => $comment->replies])
</div>
@endforeach