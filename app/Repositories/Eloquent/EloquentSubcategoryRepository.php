<?php


// app/Repositories/Eloquent/EloquentSubcategoryRepository.php

namespace App\Repositories\Eloquent;

use App\Models\Subcategory;
use App\Repositories\SubcategoryRepositoryInterface;

class EloquentSubcategoryRepository implements SubcategoryRepositoryInterface
{
    public function all()
    {
        return Subcategory::all();
    }

    public function find($id)
    {
        return Subcategory::findOrFail($id);
    }

    public function create(array $data)
    {
        return Subcategory::create($data);
    }

    public function update($id, array $data)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($data);
        return $subcategory;
    }

    public function delete($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return $subcategory->delete();
    }
}
