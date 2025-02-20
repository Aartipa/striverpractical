<?php

use App\Livewire\InvoiceDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoices', InvoiceDashboard::class);