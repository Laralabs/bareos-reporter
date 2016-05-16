<!DOCTYPE html>
<html>
<head>
    <title>{{ $director->director_name }} Backup Report: {{ date('Y-m-d') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h2><strong>Director: </strong>{{ $director->director_name }}</h2>
        <div class="table-container">
            <table id="report-table" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Success</th>
                    <th>Error</th>
                    <th>Warning</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client['id'] }}</td>
                        <td>{{ $client['name'] }}</td>
                        <td>{{ $client['success'] }}</td>
                        <td>{{ $client['error'] }}</td>
                        <td>{{ $client['warning'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
