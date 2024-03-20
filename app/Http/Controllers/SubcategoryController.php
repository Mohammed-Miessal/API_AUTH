<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Models\Subcategory;
use App\Repositories\SubcategoryRepositoryInterface;


class SubcategoryController extends Controller
{

    protected $subcategoryRepository;

    /**
     * Inject the subcategory repository instance into the controller.
     */
    public function __construct(SubcategoryRepositoryInterface $subcategoryRepository)
    {
        $this->subcategoryRepository = $subcategoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all subcategories from the repository
        $subcategories = $this->subcategoryRepository->all();
        return response()->json($subcategories);
        // Return or process the subcategories as needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoryRequest $request)
    {
        // Store the new subcategory using the repository
        $subcategory = $this->subcategoryRepository->create($request->validated());
        // Return a response or redirect as needed

        return response()->json(['message' => 'Subcategory created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        // Show the specified subcategory
        $category = $subcategory->category->pluck('name');
        return response()->json($subcategory , $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        // Update the specified subcategory using the repository
        $this->subcategoryRepository->update($subcategory->id, $request->validated());
        // Return a response or redirect as needed
        return response()->json(['message' => 'Subcategory updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        // Delete the specified subcategory using the repository
        $this->subcategoryRepository->delete($subcategory->id);
        // Return a response or redirect as needed
        return response()->json(['message' => 'Subcategory deleted successfully']);
    }
}
