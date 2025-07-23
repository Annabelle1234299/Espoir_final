<?php

use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rediriger la racine vers la liste des produits
Route::get('/', function () {
    return redirect()->route('produits.index');
});

// Module 3 simplifié - CRUD Produits uniquement

// Route du tableau de bord simplifiée (sans authentification)
Route::get('/dashboard', [EntrepreneurController::class, 'dashboard'])->name('dashboard');

// Routes CRUD pour les produits (Module 3)
Route::get('/produits', [EntrepreneurController::class, 'listProduits'])->name('produits.index');
Route::get('/produits/create', [EntrepreneurController::class, 'createProduit'])->name('produits.create');
Route::post('/produits', [EntrepreneurController::class, 'storeProduit'])->name('produits.store');
Route::get('/produits/{produit}', [EntrepreneurController::class, 'showProduit'])->name('produits.show');
Route::get('/produits/{produit}/edit', [EntrepreneurController::class, 'editProduit'])->name('produits.edit');
Route::put('/produits/{produit}', [EntrepreneurController::class, 'updateProduit'])->name('produits.update');
Route::delete('/produits/{produit}', [EntrepreneurController::class, 'destroyProduit'])->name('produits.destroy');
