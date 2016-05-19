<!DOCTYPE html>
<html>
<head>
    <title>{{ $director->director_name }} Backup Report: {{ date('Y-m-d') }}</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial; font-size: 14px; line-height: 20px; font-weight: 400; color: #3B3B3B; background: #FFFFFF">
<?php
        $client_report = $job->report_type;
?>
<div class="container" style="max-width: 600px; margin: 0 auto 100px auto; text-align: center">
    <h1>Bareos Backup Report</h1>
    <h2>{{ date('d-m-Y') }}</h2>
    @if($client_report == \App\Jobs::REPORT_TYPE_ALL)
        <h3><strong>Director: </strong>{{ $director->director_name }}</h3>
    @endif
    @if($client_report == \App\Jobs::REPORT_TYPE_SEPARATE)
        <h3><strong>Client Report: {{ $client_name }}</strong></h3>
    @endif
    <table id="report-table" class="pure-table pure-table-bordered" style="margin: 0 auto; border-collapse: collapse; border-spacing: 0; empty-cells: show; border: 1px solid #CBCBCB; border-bottom-width: 0;">
        <thead style="background-color: #E6E6E6; color: #000000; text-align: left; vertical-align: bottom">
        <tr>
            <th style="border-left: 1px solid #CBCBCB; border-bottom: 1px solid #CBCBCB; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; letter-spacing: 1px;">#</th>
            <th style="border-left: 1px solid #CBCBCB; border-bottom: 1px solid #CBCBCB; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; letter-spacing: 1px;">Client Name</th>
            <th style="border-left: 1px solid #CBCBCB; border-bottom: 1px solid #CBCBCB; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; letter-spacing: 1px; color: #5CB85C;">Success</th>
            <th style="border-left: 1px solid #CBCBCB; border-bottom: 1px solid #CBCBCB; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; letter-spacing: 1px; color: #D9534F;">Error</th>
            <th style="border-left: 1px solid #CBCBCB; border-bottom: 1px solid #CBCBCB; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; letter-spacing: 1px; color: #F0AD4E;">Warning</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td style="border-left: 1px solid #CBCBCB; border-width: 0 0 0 1px; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; border-bottom: 1px solid #CBCBCB;">{{ $client['id'] }}</td>
                <td style="border-left: 1px solid #CBCBCB; border-width: 0 0 0 1px; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; border-bottom: 1px solid #CBCBCB;">{{ $client['name'] }}</td>
                <td style="border-left: 1px solid #CBCBCB; border-width: 0 0 0 1px; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; border-bottom: 1px solid #CBCBCB;">{{ $client['success'] }}</td>
                <td style="border-left: 1px solid #CBCBCB; border-width: 0 0 0 1px; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; border-bottom: 1px solid #CBCBCB;">{{ $client['error'] }}</td>
                <td style="border-left: 1px solid #CBCBCB; border-width: 0 0 0 1px; font-size: inherit; margin: 0; overflow: visible; padding: .5em 1em; border-bottom: 1px solid #CBCBCB;">{{ $client['warning'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="footer" style="margin-top: 50px; font-size: 10px;">
        Created using Bareos Reporter by <a href="http://laralabs.uk/" style="text-decoration: underline; color: #000000;">Laralabs</a>
    </div>
</div>
</body>
</html>
