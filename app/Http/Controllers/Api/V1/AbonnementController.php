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
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Review;
use App\Models\Abonnement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\Service;
use App\Models\Job;
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
        $response = ResponseSchema::create();

        if ($id) {
            //$item = Abonnement::where('id', $id)->active()->first();
            $item = Abonnement::where('id', $id)->first();

            if (empty($item)) {
                return $response->error(404, 'not_found', "Donnée introuvable.");
            }

            $response->result = $item;
        } else {
           // $response->result = Abonnement::active()->get()->all();
            $response->result = Abonnement::all();
        }

       // return $response->send();
       return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbonnementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Abonnement $abonnement)
    {
        //
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
