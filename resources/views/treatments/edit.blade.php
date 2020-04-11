@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="/treatments/{{ $treatment->id }}" method="POST">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            @include('treatments.components.fields')
                            <div class="form-group">
                                <label>Статус</label>
                                <select class="form-control" name="status">
                                    <option @if(!$treatment->status) selected @endif value={{ null }}>Выберите статус</option>
                                    <option @if($treatment->status == 'accept') selected @endif value="accept">Принят на обследование</option>
                                    <option @if($treatment->status == 'in-progress') selected @endif value="in-progress">Находится на обследовании</option>
                                    <option @if($treatment->status == 'complete') selected @endif value="complete">Выписан</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection