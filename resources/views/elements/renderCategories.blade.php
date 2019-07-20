@foreach($categories as $category)
    <li><a href="/produtos/categoria/{{$category["id"]}}">{{$category["description"]}}</a></li>
@endforeach