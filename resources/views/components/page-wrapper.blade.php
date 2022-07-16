@props(['posts'])
<section class="blog-posts grid-system">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="all-blog-posts">
                    <div class="row">
                        {{$slot}}
                        <div class="col-lg-12">
                            {{ $posts->links() }}
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