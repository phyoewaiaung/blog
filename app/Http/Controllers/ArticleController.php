<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $articles = Article::latest()->paginate(5);
       return view('articles.article',compact('articles'));
    }

    public function detail($id)
    {
        $article = Article::find($id);
        return view('articles.detail', compact('article'));
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)){
            $article->delete();
            return redirect('/articles')->with('info','Successfully Delete');
        }
        return back()->withErrors('Unauthorize to delete this article. Because you are not the creator!');
    }

    public function add()
    {
        $categories = [
            ["id" => "1", "name" => "Tech"],
            ["id" => "2", "name" => "Health"],
            ["id" => "3", "name" => "Love"]
        ];

        return view('articles.add', compact('categories'));
    }

    public function create()
    {

        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            // 'user_id' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');
    }
    public function edit($id)
    {
        $categories = [
            ["id" => "1", "name" => "Tech"],
            ["id" => "2", "name" => "Health"],
            ["id" => "3", "name" => "Love"]
        ];
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)){
            return view('articles.edit', compact('article','categories'));
        }
        return back()->withErrors('Unauthorize to edit!');
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            // 'user_id' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles')->with('info','Updated Successfull');
    }
}
