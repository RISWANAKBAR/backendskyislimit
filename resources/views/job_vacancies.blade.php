<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Job Vacancies</title>
</head>

<body>
    <h1>All Job Vacancies</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Job Name</th>
                <th>Status</th>
                <!-- Add other table headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($jobVacancies as $vacancy)
            <tr>
                <td>{{ $vacancy->id }}</td>
                <td>{{ $vacancy->job_name }}</td>
                <td>{{ $vacancy->status }}</td>
                <!-- Add other table data as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
