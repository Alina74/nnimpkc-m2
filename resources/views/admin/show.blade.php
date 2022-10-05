@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                <div class="card mt-4">
                    <div class="card-header"><h4>{{$user->fullname}}</h4></div>
                    <div class="card-body text-center">
                        <img src="{{'/public/storage/' . $user->photo}}" class="card-img-top w-50 mb-3" alt="{{$user->name}}">
                        <p class="card-text">ФИО: {{$user->fullname}}</p>
                        <p class="card-text">Email: {{$user->email}}</p>
                        <p class="card-text">Дата рождения: {{$user->birthday}}</p>
                        <p class="card-text">Роль: {{$user->role}}</p>
                        <a href="{{route('admin.users.edit', ['user'=>$user->id])}}" class="btn btn-primary">Редактировать</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Удалить
                        </button>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить пользователя {{$user->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы точно хотите удалить пользователя?<br>
                    {{$user->name}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <form action="{{route('admin.users.destroy', ['user'=>$user->id])}}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger">Да</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
