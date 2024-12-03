<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplieController;
use Illuminate\Support\Facades\Route;

// ANCHOR: rutas para el main
Route::get('/', [IndexController::class, 'main'])->name('main');

// ANCHOR: rutas que tiene acceso el panel
Route::get('/sales', [PanelController::class, 'sales'])->name('sales');
Route::get('/supplies', [PanelController::class, 'supplies'])->name('supplies');
Route::get('/products', [PanelController::class, 'products'])->name('products');
Route::get('/offers', [PanelController::class, 'offers'])->name('offers');
Route::get('/paymentMethod', [PanelController::class, 'paymentMethod'])->name('paymentMethods');

// ANCHOR: rutas para metodos de pago
Route::get('/paymentMethod/create', [PaymentMethodController::class, 'create'])->name('paymentMethods.create');
Route::get('/paymentMethod/edit/{id}', [PaymentMethodController::class, 'edit'])->name('paymentMethods.edit');
Route::get('/paymentMethod/delete/{id}', [PaymentMethodController::class, 'delete'])->name('paymentMethods.delete');
Route::post('/paymentMethod/save', [PaymentMethodController::class, 'save'])->name('paymentMethods.save');
Route::post('/paymentMethod/update', [PaymentMethodController::class, 'update'])->name('paymentMethods.update');

// ANCHOR: rutas para los productos
Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
Route::post('/product/save', [ProductController::class, 'save'])->name('products.save');
Route::post('/product/update', [ProductController::class, 'update'])->name('products.update');

// ANCHOR: rutas para insumos
Route::get('/supplie/create', [SupplieController::class, 'create'])->name('supplies.create');
Route::get('/supplie/edit/{id}', [SupplieController::class, 'edit'])->name('supplies.edit');
Route::get('/supplie/delete/{id}', [SupplieController::class, 'delete'])->name('supplies.delete');
Route::post('/supplie/save', [SupplieController::class, 'save'])->name('supplies.save');
Route::post('/supplie/update', [SupplieController::class, 'update'])->name('supplies.update');

// ANCHOR: rutas para ventas
Route::get('/sale/create', [SaleController::class, 'create'])->name('sales.create');
Route::get('/sale/edit/{id}', [SaleController::class, 'edit'])->name('sales.edit');
Route::get('/sale/delete/{id}', [SaleController::class, 'delete'])->name('sales.delete');
Route::post('/sale/save', [SaleController::class, 'save'])->name('sales.save');
Route::post('/sale/update', [SaleController::class, 'update'])->name('sales.update');

// ANCHOR: rutas para ofertas
Route::get('/offer/create', [OfferController::class, 'create'])->name('offers.create');
Route::get('/offer/edit/{id}', [OfferController::class, 'edit'])->name('offers.edit');
Route::get('/offer/delete/{id}', [OfferController::class, 'delete'])->name('offers.delete');
Route::post('/offer/save', [OfferController::class, 'save'])->name('offers.save');
Route::post('/offer/update', [OfferController::class, 'update'])->name('offers.update');

// NOTE: Rutas para filtros
Route::post('/filter/table',[FilterController::class, 'filter'])->name('filterDate');

// NOTE: Rutas para reportes
Route::post('/report/pdf', [ReportController::class, 'report'])->name('reportPdf');
