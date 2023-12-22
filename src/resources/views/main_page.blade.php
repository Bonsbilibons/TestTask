<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>

<div>

    <h2>Registration</h2>

    @csrf
    <label for="username">Username: </label>
    <input id="username" type="text" name="username">

    <br>

    <label for="phonenumber">Phone number: </label>
    <input id="phonenumber" type="text" name="phonenumber">

    <br>
    <button type="button" class="register btn btn-info">Register</button>

    <div class="linkBoard"></div>

    @foreach($errors as $error)
        <h2>{{$error}}</h2>
    @endforeach

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var uuid;
    var userId;
    $('.register').on('click', function() {
        $.ajax({
            url: '{{ route('register') }}',
            type: 'POST',
            data: {
                username: $('#username').val(),
                phonenumber: $('#phonenumber').val(),
            },
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            "dataType": 'json',
            success: function (response) {
                if (response.status === 'error ') {
                    htmlContent = `
                        <h2>${ response.message }</h2>
                    `;
                } else {
                    uuid = response.data.link.link;
                    userId = response.data.user.id;

                    var gameUrl = '{{ route("game.main", "uuid" ) }}';
                    gameUrl = gameUrl.replace('uuid', response.data.link.link);
                    $('.linkBoard').html(`
                    <a href="${gameUrl}" id="link">
                    <button type="button" class="register btn btn-link">Play</button>
                    </a>
                `);
                }
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
</script>

</body>
</html>
