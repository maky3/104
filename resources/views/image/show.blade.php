<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Image</title>
</head>
<body>
<h1>{{ $image->filename }}</h1>
<img src="{{ asset('storage/images/' . $image->filename) }}" alt="{{ $image->filename }}">
</body>
</html>
