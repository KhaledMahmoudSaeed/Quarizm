<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        Gate::authorize("viewAny", Reservation::class);
        $id = Auth::id();
        $workshopsReserved = Reservation::with(['workshop:id,title, description, duration, date, finish'])->where("user_id", $id)->paginate(10);
        return view("reservation.index", ['workshopsReserved' => $workshopsReserved]);
    }
    public function create(): View
    {
        Gate::authorize("create", Reservation::class);
        return view("reservation.create");
    }
    public function store(StoreReservationRequest $storeReservationRequest): RedirectResponse
    {
        Gate::authorize("create", Reservation::class);
        $validateData = $storeReservationRequest->validated();
        $validateData['user_id'] = Auth::id();
        Reservation::create($validateData);
        return to_route("reservation.index")->with("success", "RESERVATION HAS BEEN SUCCESSFULLY CREATED");
    }
    public function destroy(Reservation $reservation): RedirectResponse
    {
        Gate::authorize("delete", $reservation);
        $reservation->delete();
        return to_route("reservation.index")->with("success", "RESERVATION HAS BEEN SUCCESSFULLY DELETED");
    }
}
