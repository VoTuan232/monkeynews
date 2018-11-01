<ul>
@foreach($categories as $category)
        <li><a class="btn cursor-pointer" id="cat_link" value="{{ $category->id }}">{{ $category->name }}</a>
            @if(count( $category->childrens) > 0 )
        @include('pages.show_tree_category', ['categories' => $category->childrens])
            @endif
        </li>                   
@endforeach
</ul>