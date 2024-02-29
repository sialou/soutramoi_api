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
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\Service;
use App\Models\Job;
//use Horizom\Http\Request;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class JobsController
{
    public function index(int $id = null)
    {
        $response = ResponseSchema::create();

        if ($id) {
            $item = Job::where('id', $id)->active()->first();

            if (empty($item)) {
                return $response->error(404, 'not_found', "Donnée introuvable.");
            }

            $response->result = $item;
        } else {
            $response->result = Job::active()->get()->all();
        }

       // return $response->send();
       return response()->json($response);
    }

    public function create(Request $request): ResponseInterface
    {
        $response = ResponseSchema::create();
        $post = $request->post();

        if (!$post->has('title') && $post->get('title') == '') {
            return $response->error(400, 'required_fields_missing', "Les données n'ont pas été fournis.");
        }

        $title = (string) $post->get('title');

        try {
            $item = new Job();
            $item->title = $title;
            $item->slug = Str::slug($title);

            if ($post->has('parent_id')) {
                $item->parent_id = (int) $post->get('parent_id');
            }

            $item->save();
        } catch (Throwable $e) {
            return $response->error(500, 'unknown_error', "Une erreur inattendue est survenue.");
        }

        $response->result = $item;

        return $response->send(201);
    }

    public function update(Request $request, int $id): ResponseInterface
    {
        $error = Service::getErrorResponse();
        $post = $request->post();

        if (!$post->has('title') && $post->get('title') == '') {
            $error->code = 'required_fields_missing';
            $error->message = "Le nom du JOB n'a pas été fournis.";
            return response()->json($error, 400);
        }

        $title = (string) $post->get('title');

        try {
            Job::where('id', $id)->update([
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        } catch (Throwable $e) {
            $error->code = 'unknown_error';
            $error->message = "Une erreur inattendue est survenue.";
            return response()->json($error, 400);
        }

        $data = Service::getJsonResponse(true, 'ok');
        return response()->json($data);
    }

    public function delete(int $id): ResponseInterface
    {
        $error = Service::getErrorResponse();

        try {
            $item = Job::where('id', $id)->first();

            if (empty($item)) {
                $error->code = 'not_found';
                $error->message = "Donnée introuvable.";
                return response()->json($error, 400);
            }

            $item->delete();
        } catch (Throwable $e) {
            $error->code = 'unknown_error';
            $error->message = "Une erreur inattendue est survenue.";
            return response()->json($error, 400);
        }

        $data = Service::getJsonResponse(true, 'ok');
        return response()->json($data);
    }
}
