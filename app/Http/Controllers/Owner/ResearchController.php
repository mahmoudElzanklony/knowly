<?php

namespace App\Http\Controllers\Owner;

use App\Article;
use App\ArticleFile;
use App\Http\Controllers\Controller;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResearchController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('owner.profile' , compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed',
            'bio' => 'required',
            'website' => 'required',
        ]);
        DB::beginTransaction();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->website = $request->website;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        DB::commit();
        return redirect()->route('owner.profile')->with('success','Profile updated successfully');
    }

    public function showOwner(User $user)
    {
        $articles = $user->articles;
        return view('owner.show', compact('articles' , 'user'));
    }

    public function index()
    {
        $articles = auth()->user()->articles;
        return view('owner.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('owner.articles.show', compact('article'));
    }

    public function create()
    {
        return view('owner.articles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:articles',
            'body' => 'required|min:10',
            'tags' => 'required',
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

        $article = auth()->user()->articles()->create([
            'title' => $request->title,
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
        return redirect()->route('articles.index')->with('success', 'Article created successfully');
    }

    public function edit(Article $article)
    {
        $tags = $article->tags->pluck('tag')->toArray();
        $tags = implode(',', $tags);
        return view('owner.articles.edit', compact('article', 'tags'));
    }

    public function update(Article $article, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:articles,title,' . $article->id,
            'body' => 'required|min:10',
            'tags' => 'required',
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

        $article->update([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'body' => $request->body,
        ]);

        if ($request->hasFile('files')) {
            // delete old files
            foreach ($article->articleFiles as $file) {
                \Storage::delete($file->file);
                $file->delete();
            }

            foreach ($request->file('files') as $file) {
                $article->articleFiles()->create([
                    'file' => $file->store('public/articles')
                ]);
            }
        }
        $article->tags()->sync($tagIds);
        \DB::commit();
        return redirect()->route('articles.index')->with('success', 'Article updated successfully');
    }


    public function download_file(ArticleFile $article_file)
    {
        return response()->download(storage_path('app/'.$article_file->file));
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
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }
}
