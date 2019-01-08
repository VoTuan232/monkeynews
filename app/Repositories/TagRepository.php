<?php

namespace App\Repositories;

use App\Models\Tag;
use DB;

class TagRepository extends EloquentRepository
{
    public function model()
    {
        return Tag::class;
    }

    public function getAllTag() {
        return DB::table('tags')->select('id', 'name')->get();
    }
}
