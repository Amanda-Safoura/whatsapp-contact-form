<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwilioWhatsAppController;
use App\Http\Controllers\WhatsAppCloudAPIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(TwilioWhatsAppController::class)->group(function () {
    Route::get('/', 'index');
    //Route::post('/', 'sendWhatsAppMessage');
});



/* Usage de WhatsApp Cloud API
    Décommenter cette ligne pour tester ce controller 
    et commenter la route en post juste au dessus 
*/

Route::post('/', [WhatsAppCloudAPIController::class, 'sendMessage']);
