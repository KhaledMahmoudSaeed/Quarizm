<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class WorkshopController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', Workshop::class);
        $workshops = Workshop::with(["user:id,name", "category:id,name"])->paginate(10);
        return view("workshop.index", ['workshops' => $workshops]);
    }
    public function show(Workshop $workshop): View
    {
        Gate::authorize('view', $workshop);
        $workshop->load(['user', 'category']);
        return view("workshop.show", [
            'workshop' => $workshop,
            'coach' => $workshop->user,
            'category' => $workshop->category,
        ]);
    }
    public function create(): View
    {
        Gate::authorize('create', Workshop::class);
        return view("workshop.create");
    }

    public function store(StoreWorkshopRequest $storeWorkshopRequest, ImageService $imageService): RedirectResponse
    {
        Gate::authorize('create', Workshop::class);
        $validateData = $storeWorkshopRequest->validated();
        try {
            $imgUrl = $imageService->uploadImage($storeWorkshopRequest->file('img'));
            $validateData['img'] = $imgUrl;
        } catch (\Exception $e) {
            return back()->withErrors(['img' => 'Image upload failed: ' . $e->getMessage()]);
        }
        Workshop::create($validateData);
        return to_route('workshop.index')->with("success", "WORKSHOP HAS BEEN SUCCESSFULLY CREATED");
    }

    public function edit(Workshop $workshop): View
    {
        Gate::authorize('update', $workshop);
        return view("workshop.edit", ['workshop' => $workshop]);
    }

    public function update(UpdateWorkshopRequest $updateWorkshopRequest, Workshop $workshop, ImageService $imageService): RedirectResponse
    {
        Gate::authorize('update', $workshop);
        $validateData = $updateWorkshopRequest->validated();
        if ($updateWorkshopRequest->file('img')) {
            if ($workshop->img !== config('app.workshop_default_image_url')) {
                $imagePublicId = $imageService->extractPublicId($workshop->img);
                $imageService->deleteImage($imagePublicId);
            }
            $imageUrl = $imageService->uploadImage($updateWorkshopRequest->file('img'));
            $validateData['img'] = $imageUrl;
        }
        $workshop->update($validateData);
        return to_route('workshop.index')->with("success", "WORKSHOP HAS BEEN SUCCESSFULLY UPDATED");
    }

    public function destroy(Workshop $workshop, ImageService $imageService): RedirectResponse
    {
        Gate::authorize('delete', $workshop);
        if ($workshop->img !== config('app.workshop_default_image_url')) {
            $imagePublicId = $imageService->extractPublicId($workshop->img);
            $imageService->deleteImage($imagePublicId);
        }
        $workshop->delete();
        return to_route('workshop.index')->with("success", "WORKSHOP HAS BEEN SUCCESSFULLY DELETED");
    }
}
