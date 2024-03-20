<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a category by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Category|null
     */
    public function find($id);

    /**
     * Create a new category.
     *
     * @param  array  $data
     * @return \App\Models\Category
     */
    public function create(array $data);

    /**
     * Update a category.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \App\Models\Category|null
     */
    public function update($id, array $data);

    /**
     * Delete a category.
     *
     * @param  int  $id
     * @return bool|null
     */
    public function delete($id);
}
