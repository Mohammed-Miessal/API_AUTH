<?php


namespace App\Repositories;

interface SubcategoryRepositoryInterface
{
    /**
     * Get all subcategories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a subcategory by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Subcategory|null
     */
    public function find($id);

    /**
     * Create a new subcategory.
     *
     * @param  array  $data
     * @return \App\Models\Subcategory
     */
    public function create(array $data);

    /**
     * Update a subcategory.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \App\Models\Subcategory|null
     */
    public function update($id, array $data);

    /**
     * Delete a subcategory.
     *
     * @param  int  $id
     * @return bool|null
     */
    public function delete($id);
}
