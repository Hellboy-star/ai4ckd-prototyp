# AI4CKD - Maladie Rénale Chronique

# Nom du projet : kidney-care

## Objectif :

Plateforme web pour la gestion de patients atteints de MRC, avec :

* Alertes automatiques
* Génération de dossier PDF

## Stack

* Laravel 12 + Livewire
* MySQL
* Authentification Breeze
* PDF : barryvdh/laravel-dopdf

## Lancement

'''bash
laravel new ai4ck-prototyp
composer require laravel/breeze --dev
php artisan breeze:install livewire
composer require barryvdh/laravel-dompdf
npm install
npm run dev
composer require
php artisan migrate
php artisan serve

