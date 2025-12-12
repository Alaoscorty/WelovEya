<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Variante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Contrôleur pour gérer les opérations CRUD sur les articles.
 * Ce contrôleur permet de créer, lire, mettre à jour et supprimer des articles et leurs variantes.
 */
class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles.
     * Redirige vers le contrôleur DashboardController pour l'affichage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        // Redirection vers la méthode articles du DashboardController
        return app(DashboardController::class)->articles($request);
    }

    /**
     * Affiche le formulaire de création d'un nouvel article.
     * Prépare les données nécessaires pour le formulaire.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retour de la vue du formulaire de création
        return view('dashboard.ajoutArticles');
    }

    /**
     * Stocke un nouvel article en base de données.
     * Valide les données, gère l'upload d'image et crée l'article.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validated = $request->validate([
            'id_article' => 'required|string|unique:articles',
            'nom' => 'required|string|max:255',
            'prix_vente' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string',
            'stock_global' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        // Calcul du nombre de variantes (initialement 0)
        $validated['nombre_variantes'] = 0;

        // Détermination du statut basé sur le stock
        $validated['statut'] = $validated['stock_global'] > 0 ? 'disponible' : 'epuise';

        // Création de l'article
        Article::create($validated);

        // Redirection avec message de succès
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }

    /**
     * Affiche les détails d'un article spécifique.
     * Récupère l'article avec ses variantes.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupération de l'article avec ses variantes
        $article = Article::with('variantes')->findOrFail($id);

        // Retour de la vue avec les données
        return view('dashboard.detailArticle', compact('article'));
    }

    /**
     * Affiche le formulaire d'édition d'un article.
     * Prépare les données de l'article pour l'édition.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Récupération de l'article
        $article = Article::findOrFail($id);

        // Retour de la vue du formulaire d'édition
        return view('dashboard.editArticle', compact('article'));
    }

    /**
     * Met à jour un article existant.
     * Valide les données, gère l'upload d'image et met à jour l'article.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Récupération de l'article
        $article = Article::findOrFail($id);

        // Validation des données d'entrée
        $validated = $request->validate([
            'id_article' => 'required|string|unique:articles,id_article,' . $id,
            'nom' => 'required|string|max:255',
            'prix_vente' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string',
            'stock_global' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image si elle existe
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        // Mise à jour du statut basé sur le stock
        $validated['statut'] = $validated['stock_global'] > 0 ? 'disponible' : 'epuise';

        // Mise à jour de l'article
        $article->update($validated);

        // Redirection avec message de succès
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Supprime un article de la base de données.
     * Vérifie d'abord qu'il n'est pas présent dans des commandes actives.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Récupération de l'article
        $article = Article::findOrFail($id);

        // Vérification des contraintes (présence dans des commandes actives)
        if ($article->commandes()->where('statut', '!=', 'livree')->exists()) {
            return redirect()->back()->with('error', 'Impossible de supprimer cet article car il est présent dans des commandes actives.');
        }

        // Suppression de l'image associée si elle existe
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        // Suppression des variantes associées
        $article->variantes()->delete();

        // Suppression de l'article
        $article->delete();

        // Redirection avec message de succès
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }

    /**
     * Affiche les variantes d'un article.
     * Redirige vers la gestion des variantes.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function gestionVariantes($id)
    {
        // Récupération de l'article avec ses variantes
        $article = Article::with('variantes')->findOrFail($id);

        // Retour de la vue de gestion des variantes
        return view('dashboard.gestionVariantes', compact('article'));
    }

    /**
     * Ajoute une variante à un article.
     * Valide les données et crée la variante.
     *
     * @param Request $request
     * @param int $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ajouterVariante(Request $request, $articleId)
    {
        // Récupération de l'article
        $article = Article::findOrFail($articleId);

        // Validation des données d'entrée
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'valeur' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'prix_supplementaire' => 'nullable|numeric|min:0',
        ]);

        $validated['article_id'] = $articleId;

        // Création de la variante
        Variante::create($validated);

        // Mise à jour du nombre de variantes de l'article
        $article->update(['nombre_variantes' => $article->variantes()->count() + 1]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Variante ajoutée avec succès.');
    }

    /**
     * Met à jour le stock d'un article.
     * Permet d'ajuster le stock global ou le stock d'une variante spécifique.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStock(Request $request, $id)
    {
        // Récupération de l'article
        $article = Article::findOrFail($id);

        // Validation des données d'entrée
        $request->validate([
            'stock_global' => 'required|integer|min:0',
        ]);

        // Mise à jour du stock
        $article->update([
            'stock_global' => $request->stock_global,
            'statut' => $request->stock_global > 0 ? 'disponible' : 'epuise',
        ]);

        // Redirection avec message de succès
        return redirect()->back()->with('success', 'Stock mis à jour avec succès.');
    }
}
