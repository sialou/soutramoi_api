<?php

namespace App\Controllers\Api;

use App\Helpers\Service;
use App\Models\Location;
use Horizom\Http\Request;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class LocationsController
{
    public function index(int $id = null): ResponseInterface
    {
        $error = Service::getErrorResponse();

        if ($id) {
            $item = Location::where('id', $id)->active()->first();

            if (empty($item)) {
                $error->code = 'not_found';
                $error->message = "Donnée introuvable.";
                return response()->json($error, 400);
            }

            $data = $item;
        } else {
            $data = Location::active()->get()->all();
        }

        return response()->json($data);
    }

    public function create(Request $request): ResponseInterface
    {
        $error = Service::getErrorResponse();
        $post = $request->post();

        if (!$post->has('name') && $post->get('name') == '') {
            $error->code = 'bad_request';
            $error->message = "Les données n'ont pas été fournis.";
            return response()->json($error, 400);
        }

        $name = (string) $post->get('name');

        try {
            $item = new Location();
            $item->name = $name;
            $item->slug = Str::slug($name);

            if ($post->has('parent_id')) {
                $item->parent_id = (int) $post->get('parent_id');
            }

            $item->save();
        } catch (Throwable $e) {
            $error->code = 'unknown_error';
            $error->message = "Une erreur inattendue est survenue.";
            return response()->json($error, 400);
        }

        return response()->json($item, 201);
    }

    public function update(Request $request, int $id): ResponseInterface
    {
        $error = Service::getErrorResponse();
        $post = $request->post();

        if (!$post->has('name') && $post->get('name') == '') {
            $error->code = 'bad_request';
            $error->message = "Les données n'ont pas été fournis.";
            return response()->json($error, 400);
        }

        $name = (string) $post->get('name');

        try {
            Location::where('id', $id)->update([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        } catch (Throwable $e) {
            $error->code = 'unknown_error';
            $error->message = "Une erreur inattendue est survenue.";
            return response()->json($error, 400);
        }

        $data = Service::getJsonResponse(true, 'ok');
        return response()->json($data, 200);
    }

    public function delete(int $id): ResponseInterface
    {
        $error = Service::getErrorResponse();

        try {
            $item = Location::where('id', $id)->first();

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
        return response()->json($data, 200);
    }
}
