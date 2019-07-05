@extends('adminlte::page')

@section('title', 'List users')

@section('content_header')
    <h1>List users</h1>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include("elements.notifyError")
            <form action="{{ route("user.new") }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email"  id="email" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control"/>
                </div>

                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@stop