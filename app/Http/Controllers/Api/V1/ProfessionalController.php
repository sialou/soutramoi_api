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

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $query = collect($request->query());

        $limit = 20;
        $offset = 0;
        $orderType = 'asc';

        $builder = User::hasProfessionnal()->withProfessionnalInfo();

        if ($query->has('offset')) {
            $offset = (int) $query->get('offset');
        }

        if ($query->has('limit')) {
            $limit = (int) $query->get('limit');
        }

        if ($query->has('orderType')) {
            $order = (string) $query->get('orderType');
            $orderType = strtolower($order) === 'desc' ? 'desc' : 'asc';
        }

        if ($query->has('search')) {
            $search = (string) $query->get('search') ?? '';

            // search in name, city, town, professional.company_name, professional.description, professional.job.name, professional.services
            $builder->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('city', fn ($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('town', fn ($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('professional', fn ($q) => $q->where('company_name', 'like', "%{$search}%"))
                    ->orWhereHas('professional', fn ($q) => $q->where('description', 'like', "%{$search}%"))
                    ->orWhereHas('professional', fn ($q) => $q->whereHas('job', fn ($q) => $q->where('name', 'like', "%{$search}%")));
            });
        }

        $result = $builder->orderBy('id', $orderType)
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->all();

        $resources = new UserCollection($result);

        return ResponseSchema::create(result: $resources)->send();
    }

    public function show(int $id)
    {
        $item = User::hasProfessionnal()
            ->withProfessionnalInfo()
            ->find($id);

        if (!$item || !$item->professional) {
            $response = ResponseSchema::create();
            return $response->error(400, 'professional_not_found', "Ce professionnel n'existe pas.");
        }

        $resource = new UserResource($item);

        return ResponseSchema::create(result: $resource)->send();
    }
    public function create()
    {
        return response()->json(['code' => 'not-implemented-yet', 'message' => 'Not implemented yet']);
    }

    public function update(int $id)
    {
        return response()->json(['code' => 'not-implemented-yet', 'message' => 'Not implemented yet']);
    }

    public function delete(int $id)
    {
        return response()->json(['code' => 'not-implemented-yet', 'message' => 'Not implemented yet']);
    }

    public function reviews(Request $request, int $id)
    {
        $query = collect($request->query());
        $response = ResponseSchema::create();
        $pro = Professional::find($id);

        if (!$pro) {
            return $response->error(400, 'professional_not_found', "Ce professionnel n'existe pas.");
        }

        $limit = 3;
        $offset = 0;
        $order = 'asc';

        if ($query->has('offset')) {
            $offset = (int) $query->get('offset');
        }

        if ($query->has('limit')) {
            $limit = (int) $query->get('limit');
        }

        if ($query->has('orderType')) {
            $orderType = (string) $query->get('orderType');
            $order = strtolower($orderType) === 'desc' ? 'desc' : 'asc';
        }

        $reviews = $pro
            ->reviews()
            ->with(['user:id,name,photo_url'])
            ->orderBy('created_at', $order)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($reviews);
    }

    public function rating(int $id)
    {
        $response = ResponseSchema::create();
        $pro = User::hasProfessionnal()
            ->find($id);

        if (!$pro) {
            return $response->error(400, 'professional_not_found', "Ce professionnel n'existe pas.");
        }

        $nums = [1, 2, 3, 4, 5];
        $table = (new Review())->getTable();
        $colId = 'professional_id';
        $froms = ["(SELECT COUNT(*) as total FROM $table WHERE $colId = $id) AS tt"];

        foreach ($nums as $r) {
            $froms[] = "(SELECT COUNT(*) as rate$r FROM $table WHERE $colId = $id AND rating = $r) AS c$r";
        }

        $req = DB::select("SELECT * FROM " . implode(', ', $froms));
        $result = $req[0];
        $rates = [];

        foreach ($nums as $n) {
            $prop = "rate$n";
            $rates[$n] = $result->$prop;
        }

        $rating = [
            'rates' => $rates,
            'total' => $result->total ?? 0,
            'average' => $result->total ? round($result->total / count($nums), 2) : 0,
        ];

        return response()->json($rating);
    }
}
