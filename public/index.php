<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

/*
 * l'index va analyser ce qui se trouve dans l'URL.
 * Il voit qu'il y a product, il sait qu'il doit aller chercher le Controller  de product (ProductController).
 * Le Controller product contient les méthodes qui permettent de gérer les produits
 * (ex: afficher tous les produits, afficher un produit qui correspond à un id, ou plusieurs produits qui correspondent à une category)
 * Le Controller va passer par un modèle = entité (Product)
 * L'entité Product va interroger la base de donnée, ramener les infos et les retourner au Controller
 * Le Controlleur récupère les infos et affiche le résultat dans  la view (products)
 */

