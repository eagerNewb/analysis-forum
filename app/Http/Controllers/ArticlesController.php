<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('owner',['only'=>['edit', 'update','destroy']]);
    }


    public function index()
    {
        $articles = Article::paginate(15);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'body' => 'required', 'user_id' => 'required', ]);

        Article::create($request->all());

        Session::flash('flash_message', 'Article added!');

        return redirect('articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $users = User::all();
        // $comments = Comment::where('article_id',$id);
        // foreach($article->comments as $comments){
        //     if($comments->user_id != NULL){
        //     var_dump("ima user");

                // $users = User::findOrFail($comments->user_id);
                // $username = $users->name;
                // $user = User::findOrFail(Auth::user()->id);
                
            // }else{
            //     var_dump("nema user");
            //     $username = "Anonymous";
            // }
return view('articles.show', compact('article'))->with('users', $users);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {

        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['id' => 'required', 'name' => 'required', 'body' => 'required', 'user_id' => 'required', ]);

        $article = Article::findOrFail($id);
        $article->update($request->all());

        Session::flash('flash_message', 'Article updated!');

        return redirect('articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Article::destroy($id);

        Session::flash('flash_message', 'Article deleted!');

        return redirect('articles');
    }
}
