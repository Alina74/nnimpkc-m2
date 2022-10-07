@extends('welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6 mt-3">
                @if(isset($news))
                    <h2>Редактирование {{$news->header}}</h2>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Новость отредактирована!</div>
                    @endif
                @else
                    <h1>Создание новости</h1>
                    @if(session()->has('success'))
                        <div class="alert alert-success">Новость успешно создана!</div>
                    @endif
                @endif
                <form method="post" action="{{(isset($news) ? route('news.update',['news'=>$news->id]):route('news.store'))}}" enctype="multipart/form-data">
                    @csrf
                    @isset($news)
                        <input  type="hidden" name="_method" value="put">
                    @endisset
                    <div class="mb-3">
                        <label for="inputHeader" class="form-label">Название новости:</label>
                        <input type="text" name="header" class="form-control @error('header') is-invalid @enderror" id="inputHeader" aria-describedby="invalidInputHeader" value="{{old('header')}}">
                        @error('header')
                        <div id="invalidInputHeader" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputFulldesc" class="form-label">Полное описание:</label>
                        <input type="text" name="fulldesc" class="form-control @error('fulldesc') is-invalid @enderror" id="inputFulldesc" aria-describedby="invalidInputFulldesc" value="{{old('fulldesc')}}">
                        @error('fulldesc')
                        <div id="invalidInputFulldesc" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputAbbrdesc" class="form-label">Короткое описание:</label>
                        <input type="text" name="abbrdesc" class="form-control @error('abbrdesc') is-invalid @enderror" id="inputAbbrdesc" aria-describedby="invalidInputAbbrdesc" value="{{old('abbrdesc')}}">
                        @error('abbrdesc')
                        <div id="invalidInputAbbrdesc" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputTag" class="form-label">Тэги:</label>
                        <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror" id="inputTag" aria-describedby="invalidInputTag" value="{{old('tag')}}">
                        @error('tag')
                        <div id="invalidInputTag" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input name="photo_file" class="form-control @error('photo_file') is-invalid @enderror" type="file" id="inputFile" aria-describedby="invalidInputFile">
                        @error('photo_file')
                        <div id="invalidInputFile" class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        @if(isset($news))
                            Отредактировать новость
                        @else
                            Добавить новость
                        @endif
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
