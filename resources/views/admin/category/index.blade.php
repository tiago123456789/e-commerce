@extends('adminlte::page')

@section('title', 'List users')

@section('content_header')
    <h1>List categories</h1>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include("elements.notifySuccess")
            @include("elements.notifyError")
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($categories as $category)
                        <tr>
                            <td>{{ $category["id"] }}</td>
                            <td>{{ $category["description"] }}</td>
                            <td>
                                    <a onclick="return confirm('Want remove register?')"
                                       href="{{ route("category.remove", [ "id" => $category["id"] ]) }}"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a href="{{ route("category.edit.page", [ "id" => $category["id"]]) }}"
                                    class="btn btn-warning">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                            </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop