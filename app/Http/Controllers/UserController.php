<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Http\Requests\User\UserCreateValidation;
use App\Http\Requests\User\UserUpdateValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Форма авторизации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function login()
    {
        return view('users.login');
    }

    /**
     * получение данных с формы авторизации через post
     * @param LoginValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function loginPost(LoginValidation $request)
    {
        if(Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return back()->with(['success'=>'true']);
        }
        return back()->withErrors(['auth'=>'Логин или пароль не верный']);
    }

    /**
     * форма регистрации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function Register()
    {
        return view('users.register');
    }

    /**
     * получение данных с формы регистрации через post
     * @param RegisterValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function RegisterPost(RegisterValidation $request)
    {
        $requests=$request->validated();
        $requests['password']=Hash::make($requests['password']);
        unset($requests['photo_file']);
        $photo=$request->file('photo_file')->store('public');
        $requests['photo']=explode('/', $photo)[1];
        User::create($requests);
        return redirect()->route('login')->with(['register'=>true]);
    }

    /**
     * выход из профиля
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

    /**
     *Показ всех юзеров на одной странице
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users=User::all();
        return view('admin.index', ['users'=>$users]);
    }

    /**
     * Показ страницы выбранного юзера
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function show(User $user)
    {
        return view('admin.show', compact('user'));
    }

    /**
     * Показ страницы добавления юзера
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function create()
    {
        return view('admin.CreateOrUpdate');
    }

    /**
     *Сохранение нового юзера в бд после валидации
     * @param UserCreateValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateValidation $request)
    {
        $validate = $request->validated();
        $validate['password']=Hash::make($validate['password']);
        unset($validate['photo_file']);
        $photo=$request->file('photo_file')->store('public');
        $validate['photo']=explode('/', $photo)[1];
        User::create($validate);
        return back()->with(['success'=>true]);
    }

    /**
     *Обновление указанного юзера в бд после валидации
     * @param UserUpdateValidation $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateValidation $request, User $user)
    {
        $validate=$request->validated();
        $validate['password']=Hash::make($validate['password']);
        unset($validate['photo_file']);
        if ($request->hasFile('photo_file')){
            $photo=$request->file('photo_file')->store('public');
            $validate['photo']=explode('/', $photo)[1];
        }
        $user->update($validate);
        return back()->with(['success'=>true]);
    }

    /**
     * Показ страницы редактирования юзера
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, User $user)
    {
        $request->session()->flashInput($user->toArray());
        return view('admin.CreateOrUpdate', compact('user'));
    }

    /**
     * Удаление выбранного пользователя
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
