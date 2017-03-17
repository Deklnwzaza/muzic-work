<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>History</title>
</head>
<body>
<center>
    <table class="table table-bordered" style="margin-top: 10%; width: 80%">
        <thead>
        <tr>
            <th>temp</th>
            <th>max_temp</th>
            <th>min_temp</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($weathers_historys as $weather_history)
            <tr>
                <td>{!! $weather_history->mean_temp !!} C</td>
                <td>{!! $weather_history->max_temp !!} C</td>
                <td>{!! $weather_history->min_temp !!} C</td>
                <td>{!! $weather_history->Date !!} </td>
            </tr>

        @endforeach
        </tbody>
    </table>

</center>
</body>
</html>