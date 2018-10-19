if (! function_exists('generateCategoryLists')) {
            function generateCategoryLists(array $elements, $parentId = 0,$indent = 0) {
                
                foreach ($elements as $key => $element) {
                    if ($element['parent_id'] == $parentId) {
                        
                        echo '<li>' . $element['category_name'] . '</li>;
                        
                        $children = generateCategoryLists($elements, $element['id'],$indent + 1);
                    }
                }
    }
}
