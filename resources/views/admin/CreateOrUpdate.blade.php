@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6 mt-3">
                @if(isset($user))
                    <h2>Редактирование {{$user->fullname}}</h2>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Пользователь отредактирован!</div>
                    @endif
                @else
                    <h1>Создание пользователя</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Пользователь успешно создан!</div>
                    @endif
                @endif
                <form method="post" action="{{(isset($user) ? route('admin.users.update',['user'=>$user->id]):route('admin.users.store'))}}" enctype="multipart/form-data">
                    @csrf
                    @isset($user)
                        <input  type="hidden" name="_method" value="put">
                    @endisset
                    <div class="mb-3">
                        <label for="inputFullname" class="form-label">ФИО:</label>
                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="inputFullname" aria-describedby="invalidInputFullname" value="{{old('fullname')}}">
                        @error('fullname')
                        <div id="invalidInputFullname" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" aria-describedby="invalidInputEmail" value="{{old('email')}}">
                        @error('email')
                        <div id="invalidInputEmail" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputBirthday" class="form-label">Дата рождения:</label>
                        <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror" id="inputBirthday" aria-describedby="invalidInputBirthday" value="{{old('birthday')}}">
                        @error('birthday')
                        <div id="invalidInputBirthday" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input name="photo_file" class="form-control @error('photo_file') is-invalid @enderror" type="file" id="inputFile" aria-describedby="invalidInputFile">
                        @error('photo_file')
                        <div id="invalidInputFile" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <label for="inputSelect" class="input-group-text">Роль:</label>
                        <select name="role" id="inputSelect" class="form-select @error('role') is-invalid @enderror" aria-describedby="invalidInputRole">
                            <option >Выберите...</option>
                            <option @if(old('role')=='user')selected @endif  value="user">user</option>
                            <option @if(old('role')=='admin')selected @endif value="admin">admin</option>
                            <option @if(old('role')=='moder')selected @endif  value="moder">moder</option>
                        </select>
                        @error('role')
                        <div id="invalidInputRole" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Пароль:</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" aria-describedby="invalidPasswordFeedback">
                        @error('password')
                        <div id="ValidationPasswordFeedback" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPasswordConfirmation" class="form-label">Повтор пароля:</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="inputPasswordConfirmation" aria-describedby="invalidPasswordConfirmationFeedback">
                        @error('password')
                        <div id="ValidationPasswordFeedback" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($user))
                            Отредактировать пользователя
                        @else
                            Создать нового пользователя
                        @endif
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
