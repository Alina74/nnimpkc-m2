<?php

namespace App\Http\Controllers;

use App\Http\Requests\New\NewCreateValidation;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Показ всех новостей на одной странице
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::simplePaginate(25);
        return view('users.new.main', compact('news'));
    }

    /**
     * Показ страницы добавления новости
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.new.AddOrEdit');
    }

    /**
     * Сохранение новой новости в бд после валидации
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
     * Показ страницы с выбранной новостью
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('users.new.post', compact('news'));
    }

    /**
     * Показ страницы редактирования новости
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
     * Обновление указанной новости в бд после валидации
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
     * Удаление выбранной новости
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
