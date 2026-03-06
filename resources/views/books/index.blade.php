<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


</head>
<body class="antialiased">
<ul>
    @foreach($books as $book)
        <li>
            <a href="/books/{{$book->id}}">
            {{$book->isbn}} {{ $book->title }}
            </a>
        </li>
    @endforeach
</ul>
</body>
</html>
