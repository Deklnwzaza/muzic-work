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
    <title>Temp</title>
</head>
<body>
<center>
<table class="table table-bordered" style="margin-top: 10%; width: 80%">
    <thead>
    <tr>
        <th>Date</th>
        <th>Mean_Temp </th>
        <th>Max_Temp</th>
        <th>Min_Temp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($temps as $temp)
        <tr>
            <td>{!! $temp->Date !!}</td>
            <td>{!! $temp->mean_temp !!} C</td>
            <td>{!! $temp->max_temp !!} C</td>
            <td>{!! $temp->min_temp !!} C</td>
        </tr>

    @endforeach
    </tbody>
</table>
</center>
</body>
</html>