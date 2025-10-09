<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArticleController extends Controller
{
    // Список статей для админки
    public function index(Request $request)
    {
        $query = Article::with('user');

        // Фильтр по игре
        if ($request->has('game') && $request->game) {
            $query->where('game', $request->game);
        }

        // Поиск
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Фильтр по категории
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Фильтр по статусу публикации
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(20);

        return Inertia::render('Admin/Articles/Index', [
            'articles' => $articles,
            'filters' => $request->only(['game', 'search', 'status', 'category']),
        ]);
    }

    // Форма создания статьи
    public function create()
    {
        return Inertia::render('Admin/Articles/Create');
    }

    // Сохранение новой статьи
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'game' => 'required|string',
            'category' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно создана!');
    }

    // Форма редактирования статьи
    public function edit(Article $article)
    {
        return Inertia::render('Admin/Articles/Edit', [
            'article' => $article->load('user'),
        ]);
    }

    // Обновление статьи
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'game' => 'required|string',
            'category' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Обрабатываем изображение только если загружено новое
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // Сохраняем новое
            $validated['image'] = $request->file('image')->store('articles', 'public');
        } else {
            // Если новое изображение не загружено, удаляем это поле из validated
            // чтобы старое изображение осталось в базе данных
            unset($validated['image']);
        }

        if ($validated['is_published'] && !$article->is_published) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно обновлена!');
    }

    // Удаление статьи
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно удалена!');
    }

    // Публичный список статей
    public function publicIndex(Request $request)
    {
        $query = Article::published()->with('user');

        // Фильтр по игре
        if ($request->has('game') && $request->game) {
            $query->forGame($request->game);
        }

        $articles = $query->orderBy('published_at', 'desc')->paginate(12);

        return Inertia::render('Articles/Index', [
            'articles' => $articles,
            'filters' => $request->only(['game']),
        ]);
    }

    // Просмотр статьи
    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        $article->incrementViews();
        $article->load('user');

        // Получаем похожие статьи (той же игры)
        $relatedArticles = Article::published()
            ->where('game', $article->game)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        return Inertia::render('Articles/Show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
