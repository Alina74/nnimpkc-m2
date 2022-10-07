@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8 mt-4">
                <h1>Все пользователи</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Фото</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Email</th>
                        <th scope="col">Дата рождения</th>
                        <th scope="col">Роль</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td><img width="50px" height="36px" src="/public/storage/{{$user->photo}}"></td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->birthday}}</td>
                                <td>{{$user->role}}</td>
                                <td><a href="{{route('admin.users.show', ['user'=>$user->id])}}" class="btn btn-primary">Посмотреть</a></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
