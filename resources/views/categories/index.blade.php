@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading flex-row space-between">
                    <span>Категории</span> 
                    <a href="/categories/create">
                        <button class="btn btn-link p-0">+ Создать</button>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            <a href="/categories/{{ $category->id }}/edit" class="list-group-item list-group-item-action flex-row space-between">
                                <div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $category->name }}</h5>
                                    </div>
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
