<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResearchController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.articles.create' , compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:articles',
            'body' => 'required|min:10',
            'tags' => 'required',
            'user_id' => 'required|exists:users,id',
            'files.*' => 'file'
        ]);

        \DB::beginTransaction();
        $tags = explode(',', $request->tags);
        $tagIds = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate([
                'tag' => $tag
            ]);
            $tagIds[] = $tag->id;
        }

        $article = Article::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'slug' => \Str::slug($request->title),
            'body' => $request->body,
        ]);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $article->articleFiles()->create([
                    'file' => $file->store('public/articles')
                ]);
            }
        }
        $article->tags()->attach($tagIds);
        \DB::commit();
        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully');
    }

/*    public function edit(Article $article)
    {
        $tags = $article->tags->pluck('tag')->toArray();
        $tags = implode(',', $tags);
        return view('admin.articles.edit', compact('article', 'tags'));
    }*/

/*    public function update(Article $article, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:articles,title,' . $article->id,
            'body' => 'required|min:10',
            'tags' => 'required',
            'file' => 'file'
        ]);

        \DB::beginTransaction();
        $tags = explode(',', $request->tags);
        $tagIds = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate([
                'tag' => $tag
            ]);
            $tagIds[] = $tag->id;
        }

        $article->update([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'body' => $request->body,
        ]);

        if ($request->hasFile('file')) {
            // delete old file
            if ($article->file) {
                \Storage::delete($article->file);
            }
            $article->file = $request->file->store('public/articles');
            $article->save();
        }
        $article->tags()->sync($tagIds);
        \DB::commit();
        return redirect()->route('articles.index')->with('success', 'Article updated successfully');
    }*/


    public function download_file(Article $article)
    {
        return response()->download(storage_path('app/'.$article->file));
    }

    public function destroy(Article $article)
    {
        DB::beginTransaction();
        $article->tags()->detach();
        $article->comments()->delete();
        // delete old files
        foreach ($article->articleFiles as $file) {
            \Storage::delete($file->file);
            $file->delete();
        }
        $article->delete();
        DB::commit();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully');
    }

    public function destroy_comment(Comment $comment)
    {
        DB::beginTransaction();
        $article = $comment->article;
        $comment->delete();
        DB::commit();
        return redirect()->route('admin.articles.show', $article)->with('success', 'Comment deleted successfully');
    }
}
