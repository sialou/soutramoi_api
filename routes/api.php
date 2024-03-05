<?php
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\ProfessionalController;
use App\Http\Controllers\Api\V1\RequeteController;
use App\Http\Controllers\Api\V1\AbonnementController;
use App\Http\Controllers\Api\V1\JobsController;
use App\Http\Controllers\Api\V1\CompleteServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function(){
    Route::apiResource('/services',ServiceController::class);
    Route::patch('/services/{service}/complete',CompleteServiceController::class);

});
/*  pour les professionels sm_professionals */
Route::prefix('/professionals')
    ->controller(ProfessionalController::class)
    ->name('professionals.')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::get('/{id}/reviews', 'reviews');
        Route::get('/{id}/rating', 'rating');
        //pour  les inscriptions
       // Route::post('/{id}/rating', 'rating');
    });

    Route::prefix('/v1')
    ->group(function () {
        Route::apiResource('/abonnement', AbonnementController::class);

    });
    Route::prefix('/v1')
    ->group(function () {
        Route::apiResource('/requete', RequeteController::class);

    });

    /*pour les utilisateurs inscription et connection mots de passe perdu sm_users */


    /*pour les abonements inscription et connection */
   /* Route::prefix('/abonnement')
    ->controller(AbonnementController::class)
    ->name('abonnement.')
    ->group(function () {
        Route::get('/', 'index');

    });*/

    /*pour les jobs */

    Route::prefix('/jobs')
    ->controller(JobsController::class)
    ->name('jobs.')
    ->group(function () {
        Route::get('/', 'index');
       /* Route::get('/{id}', 'show');
       //Route::get('/{id}/reviews', 'reviews');
        /*Route::get('/{id}/rating', 'rating');*/
       // Route::get('/{id}/rating', 'rating');
    });

    /*pour les requêtes(reservation et service personalisé) sm_requete*/

   /* Route::prefix('/requete')
    ->controller(RequeteController::class)
    ->name('requete.')
    ->group(function () {
        Route::get('/', 'index');

    });*/



//pour la connection
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

