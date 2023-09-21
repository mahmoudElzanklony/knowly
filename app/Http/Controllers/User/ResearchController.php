<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query();
        $top_researchers = Article::query()->select('user_id', \DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        if ($request->has('search') && $request->search != null) {
            $articles = $articles->where('title', 'like', '%' . $request->search . '%');
            $articles = $articles->orWhere('body', 'like', '%' . $request->search . '%');

            // search for tags
            $articles = $articles->orWhereHas('tags', function ($query) use ($request) {
                $query->where('tag', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('user_id') && $request->user_id != null) {
            $articles = $articles->where('user_id', $request->user_id);
        }

        if ($request->has('from') && $request->from != null) {
            $articles = $articles->where('created_at', '>=', $request->from);
        }

        if ($request->has('to') && $request->to != null) {
            $articles = $articles->where('created_at', '<=', $request->to);
        }

        if ($request->has('order_by') && $request->order_by != null) {
            if ($request->order_by == 'views')
            {
                $articles = $articles->orderBy('views', 'desc');
            }
            elseif($request->order_by == 'comments')
            {
                $articles = $articles->orderBy(function ($query) {
                    $query->select(\DB::raw('count(*)'))
                        ->from('comments')
                        ->whereColumn('comments.article_id', 'articles.id');
                }, 'desc');
            }
        }




        $articles = $articles->latest()->paginate(5);

        if ($request->ajax()) {
            return view('user.articles._articles', compact('articles'))->render();
        }

        $researchers = User::query()->whereHas('articles')->get();
        return view('user.articles.index', compact('articles', 'top_researchers', 'researchers'));
    }

    public function comment(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'comment' => 'required|min:1'
        ]);

        $article = Article::query()->findOrFail($request->article_id);
        $comment = $article->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->comment
        ]);

        return view('user.articles._comment', compact('comment'))->render();
    }

    public function show(Article $article)
    {
        // update views
        $article->increment('views');
        $article->load('comments.user');
        return view('user.articles.show', compact('article'));
    }
}
