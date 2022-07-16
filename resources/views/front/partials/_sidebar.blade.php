<div class="sidebar">
    <div class="row">
        <div class="col-lg-12">
            <div class="sidebar-item search">
                <form method="GET" action="#">
                    <input type="text" name="search" class="searchText" placeholder="type to search..."
                        autocomplete="on">
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="sidebar-item recent-posts">
                <div class="sidebar-heading">
                    <h2>Recent Posts</h2>
                </div>
                <div class="content">
                    <ul>
                        @foreach ($posts as $post)
                        <li>
                            <a href="{{route('details.post', ['slug' => $post->slug])}}">
                                <h5>{{$post->title}}</h5>
                                <span>{{$post->created_at->format('F j, Y, g:i a')}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="sidebar-item categories">
                <div class="sidebar-heading">
                    <h2>Categories</h2>
                </div>
                <div class="content">
                    <ul>
                        @foreach ($post->categories as $category)
                        <li><a href="{{route('categories.show', ['slug' => $category->name])}}">-
                                {{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>