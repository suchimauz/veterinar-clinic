@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading flex-row space-between">
                    <span>Питомцы</span> 
                    <a href="/nurslings/create">
                        <button class="btn btn-link p-0">+ Создать</button>
                    </a>
                </div>
                <div class="panel-heading">
                    <form action="/nurslings">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Категория питомца</label>
                                <select class="form-control" name="category_id">
                                    <option @if(Request()->category_id == '')) selected @endif value={{ null }}>Все</option>
                                    @foreach ($categories as $category)
                                        <option 
                                            value="{{ $category->id }}"
                                            @if(Request()->category_id == $category->id) selected @endif
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label>Поиск</label>
                                <input class="form-control" placeholder="Введите причину обращения" name="search" @if(isset($_GET['search'])) value="{{ $_GET['search'] }}" @endif>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary" type="submit">Отправить</button>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($nurslings as $nursling)
                            <a href="/nurslings/{{ $nursling->id }}/edit" class="list-group-item list-group-item-action flex-row space-between">
                                <div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $nursling->category_name }}</h5>
                                    </div>
                                    <small class="text-muted"><b>Хозяин:</b> {{ $nursling->owner_name }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
