<?php

namespace App\Http\Controllers;

use App\Http\Requests\New\NewCreateValidation;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::simplePaginate(25);
        return view('users.new.main', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.new.AddOrEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewCreateValidation $request)
    {
        $validate=$request->validated();
        unset($validate['photo_file']);
        $photo=$request->file('photo_file')->store('public');
        $validate['photo']=explode('/', $photo)[1];
        $validate['user_id']=Auth::user()->id;
        News::create($validate);
        return back()->with(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('users.new.post', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,News $news)
    {
        $request->session()->flashInput($news->toArray());
        return view('users.new.AddOrEdit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewCreateValidation $request, News $news)
    {
        $validate=$request->validated();
        unset($validate['photo_file']);
        if ($request->hasFile('photo_file')){
            $photo=$request->file('photo_file')->store('public');
            $validate['photo']=explode('/', $photo)[1];
        }
        $news->update($validate);
        return back()->with(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        $news=News::simplePaginate(25);
        return view('users.new.main', compact('news'));
    }
}
