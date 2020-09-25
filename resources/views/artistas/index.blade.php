<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel :)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Listas de artistas</h1>
    <table>
        <thead>
            <tr>
                <th>Artista/Grupo</th>
                <th>Albumes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artistas as $artista)
            <!-- Aqui muestro cada artista -->
                <tr>
                    <td>{{ $artista->Name }}</td>
                    <td>
                        @foreach($artista->albumes()->get() as $album)
                        <li>{{ $album->Title }}</li>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>