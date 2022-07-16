<x-layout>
    <div style="height:70px">&nbsp;</div>
    <x-page-wrapper :posts="$posts">
        @foreach ($posts as $post)
        <div class="col-lg-4">
            <div class="blog-post">
                <div class="blog-thumb">
                    <img src="{{asset('storage/'.$post->thumbnail)}}" alt="{{$post->title}}">
                </div>
                <div class="down-content">
                    <a href="{{route('details.post', ['slug' => $post->slug])}}">
                        <h4>{{$post->title}}</h4>
                    </a>
                    <ul class="post-info">
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
                    <p class="mb-0 pb-0">{{$post->excerpt}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </x-page-wrapper>
</x-layout>