<!DOCTYPE html>
<html>
<head>
    <title>{{ $director->director_name }} Backup Report: {{ date('Y-m-d') }}</title>

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

    <style>
        body{
            font-family: 'Helvetica Neue', Helvetica, Arial;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
            color: #3b3b3b;
            background: #2b2b2b;
        }
    </style>
</head>
<body>
<?php
        $client_report = $job->report_type;
?>
<div class="container">
    <div class="content">
        <h2><strong>Director: </strong>{{ $director->director_name }}</h2>
        @if($client_report == \App\Jobs::REPORT_TYPE_SEPARATE)
            <h3><strong>Client Report</strong></h3>
        @endif
        <div class="table-container">
            <table id="report-table" class="pure-table">
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
