<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Reservation;
use App\Models\Workshop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', Category::class);
        // list all categories
        $categories = Category::all();
        return view("category.index", ['categories' => $categories]);
    }
    public function relatedWorkshop(int $categoryId): View
    {
        Gate::authorize('viewAny', Workshop::class);

        $workshops = Workshop::with([
            'reservations' => function ($query) {
                $query->orderByDesc('available_spaces');
            }
        ])->where('category_id', $categoryId)->get();

        return view('workshop.relatedWorkshop', compact('workshops'));
    }
    public function show(Category $category): View
    {
        Gate::authorize('view', $category);
        return view("category.show", ['category' => $category]);
    }
    public function create(): View
    {
        Gate::authorize('create', Category::class);
        return view("category.create");
    }
    public function store(StoreCategoryRequest $storeCategoryRequest): RedirectResponse
    {
        Gate::authorize('create', Category::class);
        $validatedData = $storeCategoryRequest->validated();
        Category::create($validatedData);
        return to_route("category.index")->with("success", "CATEGORY HAS BEEN SUCCESSFULLY CREATED");
    }

    public function edit(Category $category): View
    {
        Gate::authorize('update', $category);
        return view("category.edit", ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        Gate::authorize('update', $category);
        $validatedData = $request->validated();
        $category->update($validatedData);
        return to_route("category.index")->with("success", "CATEGORY HAS BEEN SUCCESSFULLY UPDATED");
    }

    public function destroy(Category $category): RedirectResponse
    {
        Gate::authorize('delete', $category);
        $category->delete();
        return to_route("category.index")->with("success", "CATEGORY HAS BEEN SUCCESSFULLY DELETED");
    }
}
