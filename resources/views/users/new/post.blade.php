@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                <div class="card mt-4">
                    <div class="card-header"><h4>{{$news->header}}</h4></div>
                    <div class="card-body text-center">
                        <img src="{{'/public/storage/' . $news->photo}}" class="card-img-top w-50 mb-3" alt="{{$news->name}}">
                        <p class="card-text fs-5">Заголовок: {{$news->header}}</p>
                        <p class="card-text">Полное описание: {{$news->fulldesc}}</p>
                        <p class="card-text">Краткое описание: {{$news->abbrdesc}}</p>
                        <p class="card-text">Тэги: {{$news->tag}}</p>
                        <p class="card-text">Дата создания: {{$news->created_at}}</p>
                        <p class="card-text">Дата редактирования: {{$news->updated_at}}</p>
                        <a href="{{route('news.edit', ['news'=>$news->id])}}" class="btn btn-primary">Редактировать</a>
                        @if($news->user_id==\Illuminate\Support\Facades\Auth::user()->id)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Удалить
                        </button>
                        @endif
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
                    <h5 class="modal-title" id="exampleModalLabel">Удалить пользователя {{$news->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы точно хотите удалить пользователя?<br>
                    {{$news->name}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <form action="{{route('news.destroy', ['news'=>$news->id])}}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger">Да</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
