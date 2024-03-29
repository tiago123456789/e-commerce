@extends('adminlte::page')

@section('title', 'New product')

@section('content_header')
    <h1>New product</h1>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include("elements.notifyError")
            <form action="{{ !empty($product["id"])
                        ? route("product.edit", [ "id" => $product["id"]])
                        : route("product.new") }}"
                  method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="{{ $product["title"] ?? "" }}"
                           class="form-control" />
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control"
                              cols="30" rows="10">{{ $product["description"] ?? "" }}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="categories">Categories:</label>
                    <select name="categories[]" id="categories" multiple class="form-control">
                        @foreach($categories as $key =>  $categoryItem)
                            <option value="{{$categoryItem["id"]}}">{{$categoryItem["description"]}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" value="{{ $product["price"] ?? "" }}"
                           class="form-control" />
                </div>

                <div class="form-group">
                    <label for="width">Width:</label>
                    <input type="text" id="width" name="width" value="{{ $product["width"] ?? "" }}"
                           class="form-control" />
                </div>

                <div class="form-group">
                    <label for="height">Height:</label>
                    <input type="text" id="height" name="height" value="{{ $product["height"] ?? "" }}"
                           class="form-control" />
                </div>

                <div class="form-group">
                    <label for="length">Length:</label>
                    <input type="text" id="length" name="length"
                           value="{{ $product["length"] ?? "" }}" class="form-control" />
                </div>


                <div class="form-group">
                    <label for="weight">Weight:</label>
                    <input type="text" id="weight" name="weight"
                           value="{{ $product["weight"] ?? "" }}" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" class="form-control" />
                </div>

                <div class="form-group">
                    @if (!empty($product["url_image"]))
                        <img id="image_preview" class=""
                             src="{{$product['url_image']}}"
                             width="200" height="100" alt="Preview image" />
                    @else
                        <img id="image_preview" class="hidden"
                             src=""
                             width="200" height="100" alt="Preview image" />
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    @section("js")
        <script src="{{ asset("js/previewImage.js") }}"></script>
    @stop
@stop