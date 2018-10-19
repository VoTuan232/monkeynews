@if(!is_null($category_parent->parent))
    @include('pages._parentCategory', [ 'category_parent' => $category_parent->parent ])
@endif
&nbsp
<p class="sub_cat">
    <a href="{{ route('home.posts', ['id' => $category_parent->id, 'slug' => str_slug($category_parent->name)]) }}" class="category">{{ $category_parent->name }}</a>
</p>
<i class="fas fa-angle-double-right finger"></i>

{{-- <i class="fas fa-arrow-right"></i> --}}
