<html>
<head>
    <title>Book Detail</title>
</head>
<body>
<h1>{{ $book->title }}</h1>
<p>{{ $book->subtitle }}</p>
<p>{{ $book->isbn }}</p>

<hr />
<a href="/books">Zurück</a>
</body>
</html>
