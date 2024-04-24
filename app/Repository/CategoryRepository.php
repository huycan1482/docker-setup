<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\Base\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Category::class;
    }
}