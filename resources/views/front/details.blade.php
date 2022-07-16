<x-layout>
    <div style="height: 140px">&nbsp;</div>
    <section class="blog-posts grid-system mt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{asset('storage/'.$post->thumbnail)}}" alt="{{$post->title}}">
                                    </div>
                                    <div class="down-content">
                                        @foreach ($post->categories as $category)
                                        @if ($loop->last)
                                        <span><a
                                                href="{{route('categories.show', ['slug' => $category->name])}}">{{$category->name}}</a></span>
                                        @else
                                        <span><a
                                                href="{{route('categories.show', ['slug' => $category->name])}}">{{$category->name}}</a>,
                                        </span>
                                        @endif
                                        @endforeach
                                        <a href="javascript:void(0)">
                                            <h4>{{$post->title}}</h4>
                                        </a>
                                        <ul class=" post-info">
                                            <li><a
                                                    href="{{route('authors.show', ['slug' => $post->author->name])}}">{{ucwords($post->author->name)}}</a>
                                            </li>
                                            <li><a href="javascript:void(0)">{{$post->created_at->format('F j, Y, g:i
                                                    a')}}</a></li>
                                            <li><a href="javascript:void(0)">
                                                    @if ($post->comments->isNotEmpty())
                                                    {{$post->all_comments_count}} comments
                                                    @else
                                                    No comments
                                                    @endif
                                                </a></li>
                                        </ul>
                                        <p class="mb-0 pb-0">{{$post->body}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>Comments</h2>
                                    </div>
                                    <div class="content">
                                        @include('front.partials._comment_replies', ['comments' => $post->comments])
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item submit-comment">
                                    @auth
                                    <div class="content">
                                        <form id="comment" action="{{route('comment.store', ['post' => $post->slug])}}"
                                            method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <x-form.textarea name="body" placeholder="Type your comment" />
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" style="cursor:pointer">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @else
                                    <p>Please <a href="{{route('login')}}">LOGIN</a> or <a
                                            href="{{route('register')}}">REGISTER</a>
                                        to write a
                                        comment.</p>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <x-sidebar-component />
                </div>
            </div>
        </div>
    </section>
</x-layout>