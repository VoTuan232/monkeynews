<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends EloquentRepository
{
    public function model()
    {
        return Comment::class;
    }
}
