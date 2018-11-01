@if(!is_null($category_parent->parent))
    @include('pages._parentCategory', [ 'category_parent' => $category_parent->parent ])
@endif
<a class="cate-childrens" href="{{ route('home.posts', ['id' => $category_parent->id, 'slug' => str_slug($category_parent->name)]) }}">{{ $category_parent->name }}</a>

