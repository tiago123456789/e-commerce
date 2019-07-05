@extends('adminlte::page')

@section('title', 'List users')

@section('content_header')
    <h1>List users</h1>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include("elements.notifySuccess")
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($users as $user)
                        <tr>
                            <td>{{ $user["id"] }}</td>
                            <td>{{ $user["name"] }}</td>
                            <td>{{ $user["email"] }}</td>
                            <td>
                                @if (\Illuminate\Support\Facades\Auth::id() != $user["id"])
                                    <a onclick="return confirm('Want remove register?')"
                                       href="{{ route("user.remove", [ "id" => $user["id"] ]) }}"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop