<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3>Check Score</h3>
        <form action="{{ route('calculate') }}" method="POST">@csrf
            <div>
                <label>Correct Answer:</label>
                <textarea name="correct_answer" class="form-control" required></textarea>
            </div>
            <div>
                <label>Candidate Response:</label>
                <textarea name="response" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Calculate Score</button>
        </form>
    </div>
</body>
</html>
