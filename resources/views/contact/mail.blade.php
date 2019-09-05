<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h4>Vous avez recu un mail !</h4>
    <p>De : <strong>{{ $from }}</strong></p>
    <p>Objet : {{ $subject }}</p>
    <p>"{{ $content }}"</p>
</body>
</html>