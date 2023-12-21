<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Game Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<h2>Game</h2>

<button type="button" class="play_button">Imfeelinglucky</button>

<div class="results_of_game"></div>

<button type="button" class="history_button">History</button>


<div id="uuid" data-uuid="{{ $uuid }}"></div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var uuid = $('#uuid').data('uuid');

    $('.play_button').on('click', function() {
        $.ajax({
            url: '{{ route('game.play') }}',
            type: 'POST',
            data: {
                uuid: uuid ,
            },
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            dataType: 'json',
            success: function (response) {
                let htmlContent;

                if (response.error) {
                    htmlContent = `
                        <h2>${response.error}</h2>
                    `;
                }
                else {
                    htmlContent = `
                        <h2>${response.result}</h2>
                        <br>
                        <h2>Your score: ${response.score}</h2>
                        <h2>Your winnings are: ${response.sumOfWin}</h2>
                    `;
                }

                $('.results_of_game').html(htmlContent);
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    $('.history_button').on('click', function() {
        $.ajax({
            url: '{{ route('game.history') }}',
            type: 'POST',
            data: {
                uuid: uuid ,
            },
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            dataType: 'json',
            success: function (response) {
                let htmlContent = '';

                if (response.error) {
                    htmlContent = `
                        <h2>${response.error}</h2>
                    `;
                }
                else {
                    for(let i; i <= response.length - 1; i++)
                    {
                        htmlContent += (`
                            <br>
                            <h3>${response[i].result ? "Win" : "Lose"}</h3>
                            <h4>Score: ${response[i].score}</h4>
                            <h4>Sum Of Win: ${response[i].sum_of_win}</h4>
                            <h4>Played in ${response[i].created_at}</h4>
                    `);
                    }
                }

                $('.results_of_game').html(htmlContent);
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
