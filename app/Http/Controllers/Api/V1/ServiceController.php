<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreserviceRequest;
use App\Http\Requests\UpdateserviceRequest;
use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ServiceResource;



class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Service::all();
        return ServiceResource :: collection(Service::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreserviceRequest $request)
    {
        //
        $service=Service::create($request->validated());
        return ServiceResource::make($service);
    }

    /**
     * Display the specified resource.
     */
    public function show(service $service)
    {
        return ServiceResource :: make($service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(service $service)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateserviceRequest $request, service $service)
    {
       $service->update($request->validated());
       return ServiceResource::make($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        //
        $service->delete();
        return response()->noContent();
    }
}
