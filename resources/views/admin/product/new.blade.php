@extends('adminlte::page')

@section('title', 'New product')

@section('content_header')
    <h1>New product</h1>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include("elements.notifyError")
            <form action="" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control"
                              cols="30" rows="10">{{ $product["description"] ?? "" }}
                    </textarea>
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
                    <label for="heigth">Height:</label>
                    <input type="text" id="height" name="height" value="{{ $product["heigth"] ?? "" }}"
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
                    <img id="image_preview" class="hidden"
                         src=""
                         width="200" height="100" alt="Preview image" />
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