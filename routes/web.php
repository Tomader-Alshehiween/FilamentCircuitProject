<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Exports\CircuitExport;
use App\Exports\EventExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/circuit-export', function() {
    return Excel::download(new CircuitExport, 'circuits.xlsx');
});

Route::get('/event-export', function() {
    return Excel::download(new EventExport, 'Events.xlsx');
});
