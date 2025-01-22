<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ItemController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('checklists', [ChecklistController::class, 'index']);
    Route::post('checklists', [ChecklistController::class, 'store']);
    Route::put('checklists/{checklist}', [ChecklistController::class, 'update']);
    Route::get('checklists/{checklist}', [ChecklistController::class, 'show']);
    Route::delete('checklists/{checklist}', [ChecklistController::class, 'destroy']);

    Route::post('checklists/{checklist}/items', [ItemController::class, 'store']);
    Route::put('checklists/{checklist}/items/{item}', [ItemController::class, 'update']);
    Route::get('checklists/{checklist}/items/{item}', [ItemController::class, 'show']);
    Route::delete('checklists/{checklist}/items/{item}', [ItemController::class, 'destroy']);
});
