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


class CompleteServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //pour le champ complete
       $service->is_completed=$request->is_completed;
       $task->save();
       return ServiceResource::make($task);
    }
}
