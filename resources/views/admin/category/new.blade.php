@extends('adminlte::page')

@section('title', 'List categorys')

@section('content_header')
    <h1>{{ (empty($category["id"]) ? "Add" : "Edit") }} categories</h1>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include("elements.notifyError")
            <form action="{{  (empty($category["id"]) ? route("category.new") : route("category.edit", [ "id" => $category["id"]])) }}"
                  method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description"
                              class="form-control"
                              rows="3">{{ $category["description"] ?? "" }}
                    </textarea>
                </div>

                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@stop