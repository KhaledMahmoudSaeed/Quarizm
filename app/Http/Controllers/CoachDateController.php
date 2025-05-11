<?php

namespace App\Http\Controllers;

use App\Models\CoachDate;
use App\Http\Requests\StoreCoachDateRequest;
use App\Http\Requests\UpdateCoachDateRequest;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CoachDateController extends Controller
{
    public function show(CoachDate $coachDate): View
    {
        Gate::authorize("view", $coachDate);
        return view("coachdata.show", ['coachdata' => $coachDate]);
    }
    public function create(): View
    {
        Gate::authorize("create", CoachDate::class);
        return view("coachdata.create");
    }
    public function store(StoreCoachDateRequest $storeCoachDateRequest, ImageService $imageService): RedirectResponse
    {
        Gate::authorize("create", CoachDate::class);
        $validateData = $storeCoachDateRequest->validated();
        $imgUrl = $imageService->uploadImage($storeCoachDateRequest->file('certificate_img'));
        $validateData['certificate_img'] = $imgUrl;
        CoachDate::create($validateData);
        return to_route("coachdata.show")->with("success", "YOUR DATA HAS BEEN SUCCESSFULLY CREATED");
    }
    public function edit(CoachDate $coachDate): View
    {
        Gate::authorize("update", $coachDate);
        return view("coachdata.edit", ['coachdate' => $coachDate]);
    }
    public function update(UpdateCoachDateRequest $updateCoachDateRequest, CoachDate $coachDate, ImageService $imageService): RedirectResponse
    {
        Gate::authorize("update", $coachDate);
        $validateData = $updateCoachDateRequest->validated();
        if ($updateCoachDateRequest->file('certificate_img')) {
            try {
                if (!empty($coachDate->certificate_img)) {
                    $imagePublicId = $imageService->extractPublicId($coachDate->certificate_img);
                    $imageService->deleteImage($imagePublicId);
                }

                $imageUrl = $imageService->uploadImage($updateCoachDateRequest->file('certificate_img'));
                $validateData['certificate_img'] = $imageUrl;

            } catch (\Exception $e) {
                return back()->withErrors(['certificate_img' => 'Image upload failed: ' . $e->getMessage()]);
            }
        }

        $coachDate->update($validateData);
        return to_route("coachdata.edit", $coachDate)->with("success", "YOUR DATA HAS BEEN SUCCESSFULLY UPDATED");
    }

    public function destroy(CoachDate $coachDate, ImageService $imageService): RedirectResponse
    {
        Gate::authorize("delete", $coachDate);
        $imagePublicId = $imageService->extractPublicId($coachDate->certificate_img);
        $imageService->deleteImage($imagePublicId);
        $coachDate->delete();
        return to_route("profile.edit")->with("success", "YOUR DATA HAS BEEN SUCCESSFULLY DELETED");
    }
}
