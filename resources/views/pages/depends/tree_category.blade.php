@foreach($categories as $category)
            @if($category->childrens->count() > 0 )
                <li><a href="#">{{ $category->name }}<!-- <i class="fas fa-angle-right"></i> --></a><span class="dropRight"></span>
                    <ul>
            @include('pages.depends.tree_category', ['categories' => $category->childrens])
                    </ul>
                </li>
            @else
            <li><a href="about.html">{{ $category->name }}</a></li>
            @endif
            <hr>
@endforeach