@extends('adminlte::page')

@section('title', 'List products')

@section('content_header')
    <h1>List products</h1>
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
                            <th>Width</th>
                            <th>Height</th>
                            <th>Length</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($products as $product)
                        <tr>
                            <td>{{ $product["id"] }}</td>
                            <td>{{ $product["description"] }}</td>
                            <td>{{ $product["price"] }}</td>
                            <td>{{ $product["width"] }}</td>
                            <td>{{ $product["height"] }}</td>
                            <td>{{ $product["length"] }}</td>
                            <td>{{ $product["weight"] }}</td>
                            <td>
                                    {{--<a onclick="return confirm('Want remove register?')"--}}
                                       {{--href="{{ route("product.remove", [ "id" => $product["id"] ]) }}"--}}
                                       {{--class="btn btn-danger">--}}
                                        {{--<i class="fa fa-trash"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="{{ route("product.edit.page", [ "id" => $product["id"]]) }}"--}}
                                    {{--class="btn btn-warning">--}}
                                        {{--<i class="fa fa-pencil"></i>--}}
                                    {{--</a>--}}
                            </td>
                        </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop