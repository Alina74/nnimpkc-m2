@extends('welcome')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 p-3">
                <h2>Лента новостей</h2>
                    @auth
                        <a href="{{route('news.create')}}" class="btn btn-outline-primary mt-2 mb-4 w-25 fs-5">Добавить новость</a>
                    @endauth
                <div class="row mb-2">
                    @foreach($news as $new)
                        <div class="col-2 mt-2 w-25">
                            <div class="card h-100" style="width: 100%">
                                <img src="/public/storage/{{$new->photo}}" class="card-img-top w-100 h-50" alt="{{$new->name}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$new->header}}</h5>
                                    <p class="card-text fs-5">{{$new->abbrdesc}}</p>
                                    <p class="card-text fs-7">{{$new->fulldesc}}</p>
                                    <p class="card-text">{{$new->tag}}</p>
                                    <p class="card-text">{{$new->created_at}}</p>
                                    <a href="{{route('news.show', ['news'=>$new->id])}}" class="btn btn-primary">Посмотреть</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$news->links()}}
            </div>
        </div>
    </div>
@endsection
