<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryRepository;

    /**
     * Inject the category repository instance into the controller.
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all categories from the repository
        $categories = $this->categoryRepository->all();
        return response()->json($categories);
        // Return or process the categories as needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form for creating a category
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // Store the new category using the repository
        $category = $this->categoryRepository->create($request->validated());
        // Return a response or redirect as needed
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Show the specified category
      return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Show the form for editing the category
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Update the category using the repository
        $this->categoryRepository->update($category->id, $request->validated());
        // Return a response or redirect as needed

        return response()->json(['message' => 'Category updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete the category using the repository
        $this->categoryRepository->delete($category->id);
        // Return a response or redirect as needed
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
