<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mined</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>All Data Mined</h1>
    
    @if ($data->isEmpty())
        <p>No data available in the database.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $record)
                    <tr>
                        @foreach ($columns as $column)
                            <td>{{ $record->$column }}</td> 
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>

