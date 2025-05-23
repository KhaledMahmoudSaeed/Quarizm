<?php

namespace App\Http\Controllers;

use App\Models\PrivateSession;
use App\Http\Requests\StorePrivateSessionRequest;
use App\Http\Requests\UpdatePrivateSessionRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PrivateSessionController extends Controller
{
    public function index(): View
    {
        Gate::authorize("viewAny", PrivateSession::class);

        $id = Auth::id();

        $isCoach = PrivateSession::where("coach_id", $id)->exists();

        if ($isCoach) {
            // Get all coachee IDs for this coach
            $coacheeIds = PrivateSession::where("coach_id", $id)->pluck("coachee_id");

            // Get sessions where coachee_id in $coacheeIds, eager load coachee
            $privateSessionsData = PrivateSession::with("coachee")
                ->whereIn('coachee_id', $coacheeIds)
                ->get(['date', 'coachee_id']);
        } else {
            // Get all coach IDs for this coachee
            $coachIds = PrivateSession::where("coachee_id", $id)->pluck("coach_id");

            // Get sessions where coach_id in $coachIds, eager load coach
            $privateSessionsData = PrivateSession::with("coach")
                ->whereIn('coach_id', $coachIds)
                ->get(['date', 'coach_id']);
        }

        return view("privatesession.index", ['privateSessionsData' => $privateSessionsData]);
    }

    public function show(PrivateSession $privatesession): View
    {
        Gate::authorize("view", $privatesession);
        return view("privatesession.show", ['privatesession' => $privatesession]);
    }
    public function create(): View
    {
        Gate::authorize("create", PrivateSession::class);
        return view("privatesession.create");
    }
    public function store(StorePrivateSessionRequest $storePrivateSessionRequest): RedirectResponse
    {
        Gate::authorize("create", PrivateSession::class);
        $validatedData = $storePrivateSessionRequest->validated();
        PrivateSession::create($validatedData);
        return to_route("privatesession.index")->with("success", "PRIVATESESSION HAS BEEN SUCCESSFULLY CREATED");
    }

    public function edit(PrivateSession $privatesession): View
    {
        Gate::authorize("update", $privatesession);
        return view("privatesession.edit", ['privatesession' => $privatesession]);
    }

    public function update(UpdatePrivateSessionRequest $request, PrivateSession $privatesession): RedirectResponse
    {
        Gate::authorize("update", $privatesession);
        $validatedData = $request->validated();
        $privatesession->update($validatedData);
        return to_route("privatesession.index")->with("success", "PRIVATESESSION HAS BEEN SUCCESSFULLY UPDATED");
    }

    public function destroy(PrivateSession $privatesession): RedirectResponse
    {
        Gate::authorize("delete", $privatesession);
        $privatesession->delete();
        return to_route("privatesession.index")->with("success", "PRIVATESESSION HAS BEEN SUCCESSFULLY DELETED");
    }
}
