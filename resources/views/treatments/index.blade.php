@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading flex-row space-between">
                    <span>Обращения</span> 
                    <a href="/treatments/create">
                        <button class="btn btn-link p-0">+ Создать</button>
                    </a>
                </div>
                <div class="panel-heading">
                    <form action="/treatments">
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
                            <div class="col-md-4">
                                <label>Статус</label>
                                <select class="form-control" name="status">
                                    <option @if(Request()->status != '') selected @endif value={{ null }}>Все</option>
                                    <option @if(Request()->status == 'accept') selected @endif value="accept">Принят на обследование</option>
                                    <option @if(Request()->status == 'in-progress') selected @endif value="in-progress">Находится на обследовании</option>
                                    <option @if(Request()->status == 'complete') selected @endif value="complete">Выписан</option>
                                </select>
                            </div>
                            <div class="col-md-4">
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
                        @forelse ($treatments as $treatment)
                            <a href="/treatments/{{ $treatment->id }}/edit" class="list-group-item list-group-item-action flex-row space-between">
                                <div>
                                    <div class="d-flex w-100 justify-content-between">
                                    @if ($treatment->status == 'in-progress')
                                        <span class="badge badge-primary">Находится на обследовании</span>
                                    @elseif ($treatment->status == 'complete')
                                        <span class="badge badge-success">Выписан из поликлиники</span>
                                    @else
                                        <span class="badge badge-warning">Принят на обследование</span>
                                    @endif
                                    <h5 class="mb-1">{{ $treatment->category_name }}</h5>
                                    <small class="text-muted">{{ date('d.m.Y H:i',strtotime($treatment->created_at)) }}</small>
                                    </div>
                                    <p class="mb-1">{{ $treatment->complaint }}</p>
                                    <small class="text-muted">{{ $treatment->nurslings_owner_name }}</small>
                                </div>
                            </a>
                        @empty
                            Обращений нет
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
