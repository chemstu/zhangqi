<div class="aside-widget text-center">
    <a href="#" style="display: inline-block;margin: auto;">
        <img class="img-responsive" src="{{asset('front/img/qrcode.jpg')}}" alt="">
    </a>
</div>
<!-- /ad -->

<!-- catagories -->
<div class="aside-widget">
    <div class="section-title">
        <h2>文章分类</h2>
    </div>
    <div class="category-widget">
        <ul>
            @foreach($categories as $category)
                <li><a href="" class="{{$category->color}}">{{$category->name}}<span>340</span></a></li>
            @endforeach
         </ul>
    </div>
</div>
<!-- /catagories -->

<!-- tags -->
<div class="aside-widget">
    <div class="tags-widget">
        <ul>
            @foreach($tags as $tag)
            <li><a href="{{route('tag',$tag->id)}}">{{$tag->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<!-- /tags -->