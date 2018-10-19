{{-- <ul>
@foreach($categories as $category)
        <li>{{ $category->name }}
            @if(count( $category->childrens) > 0 )
                <ul>
                @foreach($category->childrens as $subcategory)
                    <li>{{ $subcategory->name }}</li>
                @endforeach 
                </ul>
            @endif
        </li>                   
@endforeach
</ul>
 --}}
{{-- <ul>
    {!! generateCategoryLists($categories, $parentId=0, $indent=0) !!}
</ul> --}}

{{-- if (! function_exists('generateCategoryLists')) {
            function generateCategoryLists(array $elements, $parentId = 0,$indent = 0) {
                
                foreach ($elements as $key => $element) {
                    if ($element['parent_id'] == $parentId) {
                        
                        echo '<li>' . $element['category_name'] . '</li>;
                        
                        $children = generateCategoryLists($elements, $element['id'],$indent + 1);
                    }
            }
    }
}


@endif

<ul>
    {!! generateCategoryLists($categories, $parentId=0, $indent=0) !!}
</ul> --}}

<ul>
@foreach($categories as $category)
        <li>{{ $category->name }}
            @if(count( $category->childrens) > 0 )
        @include('admin.categories.test', ['categories' => $category->childrens])
            @endif
        </li>                   
@endforeach
</ul>