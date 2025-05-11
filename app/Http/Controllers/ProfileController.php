<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpParser\Node\Expr\FuncCall;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        Gate::authorize('update', $request->user());

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function index(): View
    {
        Gate::authorize('viewAny', User::class);
        $users = User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $profileUpdateRequest, ImageService $imageService): RedirectResponse
    {
        Gate::authorize("update", $profileUpdateRequest->user());
        $user = $profileUpdateRequest->user();
        $user->fill($profileUpdateRequest->validated());

        // Reset email verification if email changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle image upload if exists
        if ($profileUpdateRequest->hasFile('img')) {
            if ($user->img !== config('app.user_default_image_url')) {
                $imagePublicId = $imageService->extractPublicId($user->img);
                $imageService->deleteImage($imagePublicId);
            }

            $imageUrl = $imageService->uploadImage($profileUpdateRequest->file('img'));
            $user->img = $imageUrl;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'YOUR PROFILE HAS BEEN SUCCESSFULLY UPDATED');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, ImageService $imageService): RedirectResponse
    {
        Gate::authorize("delete", $request->user());

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete user image if not default
        if ($user->img && $user->img !== config('app.user_default_image_url')) {
            $imagePublicId = $imageService->extractPublicId($user->img);
            $imageService->deleteImage($imagePublicId);
        }
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'YOUR ACCOUNT HAS BEEN SUCCESSFULLY DELETED.');
    }
    public function delete(User $user): RedirectResponse
    {
        Gate::authorize("delete", $user);
        if (!$user->isAdmin()) {
            $user->delete();
            return to_route("users.index")->with("success", "ACCOUNT HAS BEEN SUCCESSFULLY DELETED");
        } else {
            abort(403, "YOU DON'T HAVE PERMISSION TO DO THIS ACTION");
        }

    }
}
