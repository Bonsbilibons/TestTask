<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div>

    <h2>Registration</h2>

    <form method="POST" action="{{ route('user.links') }}">
        @csrf

        <label for="username">Username: </label>
        <input id="username" type="text" name="username">

        <br>

        <label for="phonenumber">Phone number: </label>
        <input id="phonenumber" type="text" name="phonenumber">

        <br>
        <button type="button" class="register">Log in</button>
    </form>

    <div class="linkBoard">

    </div>

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
            url: '{{ route('user.links') }}',
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
                uuid = response.link.link;
                userId = response.user.id;

                var gameUrl = '{{ route("game.main", "uuid" ) }}';
                gameUrl = gameUrl.replace('uuid', response.link.link);
                $('.linkBoard').html(`
                    <a href="${gameUrl}" id="link">Game</a>
                    <br>
                    <button type="button" class="recreate">Recreate link</button>
                    <button type="button" class="deactivate">Deactivate link</button>
                `);
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    $('.linkBoard').on('click', '.deactivate', function() {
        $.ajax({
            url: '{{ route('link.deactivate') }}',
            type: 'POST',
            data: {
                uuid: uuid,
            },
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            "dataType": 'json',
            success: function (response) {
                $('#link').remove();
                $('.deactivate').remove();
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    $('.linkBoard').on('click', '.recreate', function() {
        $.ajax({
            url: '{{ route('link.recreate') }}',
            type: 'POST',
            data: {
                uuid: uuid,
                userId: userId,
            },
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            "dataType": 'text',
            success: function (response) {
                uuid = response;

                var gameUrl = '{{ route("game.main", "uuid" ) }}';
                gameUrl = gameUrl.replace('uuid', response);

                $('.linkBoard').html(`
                    <a href="${gameUrl}" id="link">Game</a>
                    <br>
                    <button type="button" class="recreate">Recreate link</button>
                    <button type="button" class="deactivate">Deactivate link</button>
                `);
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
