<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\urlGeneratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [urlGeneratorController::class, 'main']);

Route::post('/', [urlGeneratorController::class, 'getShortUrl']);

Route::get('/{denst_url}', function ($denst_url) {
    $urlGeneratorController = new urlGeneratorController();
    $source_url = $urlGeneratorController->redirectShortUrl($denst_url);
    if ($source_url)  {
        return redirect()->away($source_url);
    } else {
        return $urlGeneratorController->main();
    }
});
