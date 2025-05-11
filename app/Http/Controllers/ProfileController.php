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
        return view('dashboard.users.index', ['users' => $users]);
    }
    public function coaches(): View
    {
        Gate::authorize('coaches', User::class);
        $users = User::where("role", "=", "Coach")->paginate(10);
        return view('users.coaches', ['users' => $users]);
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
    public function destroy(Request $request, ImageService $imageService, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        Gate::authorize('delete', $user);

        // Validate current user's password (for security)
        if ($user === $request->user()) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

        }
        // Delete user image if not default
        if ($user->img && $user->img !== config('app.user_default_image_url')) {
            $imagePublicId = $imageService->extractPublicId($user->img);
            $imageService->deleteImage($imagePublicId);
        }

        $user->delete();

        // If the deleted user is the currently authenticated user, logout and invalidate session
        if ($user->id === $request->user()->id) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/')->with('success', 'YOUR ACCOUNT HAS BEEN SUCCESSFULLY DELETED.');
        }

        // Otherwise, redirect back or to users list with success message
        return redirect()->route('users.index')->with('success', 'User has been successfully deleted.');
    }

}
