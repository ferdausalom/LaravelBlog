<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach ($featureds as $featured)
            <div class="item">
                <div class="featured_shadow"></div>
                <img src="{{asset('storage/'.$featured->thumbnail)}}" alt="{{$featured->title}}">
                <div class="item-content">
                    <div class="main-content">
                        <div class="meta-category">
                            @foreach ($featured->categories as $category)
                            @if ($loop->last)
                            <span><a
                                    href="{{route('categories.show', ['slug' => $category->name])}}">{{$category->name}}</a></span>
                            @else
                            <span><a
                                    href="{{route('categories.show', ['slug' => $category->name])}}">{{$category->name}}</a>,
                            </span>
                            @endif
                            @endforeach
                        </div>
                        <a href="{{route('details.post', ['slug' => $featured->slug])}}">
                            <h4>{{$featured->title}}</h4>
                        </a>
                        <ul class="post-info">
                            <li><a
                                    href="{{route('authors.show', ['slug' => $featured->author->name])}}">{{$featured->author->name}}</a>
                            </li>
                            <li><a href="javascript:void(0)">{{$featured->created_at->format('F j, Y, g:i
                                    a')}}</a></li>
                            <li><a href="javascript:void(0)">
                                    @if ($featured->comments->isNotEmpty())
                                    {{$featured->all_comments_count}} comments
                                    @else
                                    No comments
                                    @endif
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>