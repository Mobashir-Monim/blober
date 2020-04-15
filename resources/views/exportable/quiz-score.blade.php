<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Score</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Attempted</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scores as $id => $score)
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $score['name'] }}</td>
                    <td>{{ $score['start'] }}</td>
                    <td>{{ $score['end'] }}</td>
                    <td>{{ $score['attempted'] }}</td>
                    <td>{{ $score['score'] }}</td
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>