<ul class="fa-ul">
@foreach($trees as $category)
        <li><i class="fa fa-check-square"></i><a class="btn cursor-pointer" id="cat_link" value="{{ $category->id }}">{{ $category->name }}</a>
            @if(count( $category->childrens) > 0 )
        @include('admin.categories.partials._tree', ['trees' => $category->childrens])
            @endif
        </li>                   
@endforeach
</ul>