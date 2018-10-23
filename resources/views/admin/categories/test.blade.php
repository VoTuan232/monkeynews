<ul>
@foreach($categories as $category)
        <li>{{ $category->name }}
            @if(count( $category->childrens) > 0 )
        @include('admin.categories.test', ['categories' => $category->childrens])
            @endif
        </li>                   
@endforeach
</ul>