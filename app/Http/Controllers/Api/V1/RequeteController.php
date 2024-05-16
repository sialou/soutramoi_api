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
use App\Helpers\ResponseSchema;
use App\Http\Resources\RequeteResource;
use App\Http\Requests\StoreRequeteRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Review;
use App\Models\User;
use App\Models\Requete;
use Illuminate\Support\Facades\DB;
use App\Helpers\Service;
use App\Models\Job;
//use Horizom\Http\Request;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class RequeteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RequeteResource:: collection(Requete::all());
    }

    /**
     * Show the form for creating a new resource.
     */
  /*  public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequeteRequest $request)
    {
        //
       /* $resource= Resource ::create($request->validated());
        return  RequeteResource::make($resource);*/
        $requete= Requete ::create($request->validated());
        return RequeteResource::make($requete);
    }

    /**
     * Display the specified resource.
     */
    public function show(Requete $requete)
    {
        //

        return RequeteResource::  make($Requete);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requete $requete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequeteRequest $request, Requete $requete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requete $requete)
    {
        //
    }
}
