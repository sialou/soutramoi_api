<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
use App\Models\Professional;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\AbonnementResource;
use App\Helpers\ResponseSchema;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Review;
use App\Models\Abonnement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\Service;
use App\Models\Job;
use App\Http\Requests\StoreAbonnementRequest;
//use Horizom\Http\Request;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Throwable;


class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return AbonnementResource:: collection(Abonnement::all());
    }

    /**
     * Show the form for creating a new resource.
     */
   /* public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbonnementRequest $request)
    {
        $abonnement= Abonnement ::create($request->validated());
        return AbonnementResource::make($abonnement);
    }

    /**
     * Display the specified resource.
     */
    public function show(Abonnement $abonnement)
    {
        //
        return AbonnementResource:: make($abonnement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonnement $abonnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbonnementRequest $request, Abonnement $abonnement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abonnement $abonnement)
    {
        //
    }
}
