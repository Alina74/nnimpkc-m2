@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8 mt-4">
                <h1>Все пользователи</h1>
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-4 mt-4">
                            <div class="card" style="width: 100%">
                                <img src="/public/storage/{{$user->photo}}" class="card-img-top" alt="{{$user->name}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->fullname}}</h5>
                                    <p class="card-text">Email: {{$user->email}}</p>
                                    <p class="card-text">Дата рождения: {{$user->birthday}}</p>
                                    <p class="card-text">Роль: {{$user->role}}</p>
                                    <a href="{{route('admin.users.show', ['user'=>$user->id])}}" class="btn btn-primary">Посмотреть</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
