<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تراکنش ناموفق</title>
    <!-- Add Bootstrap 5 CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <style>
        /* Center the content vertically */
        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="container text-center">
    <h3>تراکنش ناموفق</h3>
    @if($agent->isMobile())
        @if($agent->isiOS() || $agent->isiPadOS())
            <a href="days21appScheme:/app/sub_failed" class="btn btn-primary">بازگشت به اپلیکیشن</a>
        @else
            <a href="intent://21dayapp.com/app/sub_failed/#Intent;scheme=https;package=com.days21.app;end" class="btn btn-primary">بازگشت به اپلیکیشن</a>
        @endif
    @else
        <a href="https://webapp.21dayapp.com/sub_failed" class="btn btn-primary">بازگشت به اپلیکیشن</a>
    @endif
</div>

<!-- Add Bootstrap 5 JS scripts (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</body>
</html>
