<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends EloquentRepository
{
    public function model()
    {
        return Category::class;
    }

    public function getCategoryForHome() {
        return $this->model->where('parent_id', null)->take(5)->get();
    }

}
