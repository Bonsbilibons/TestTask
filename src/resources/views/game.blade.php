<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Game Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>

<h2>Game</h2>

<button type="button" class="play_button btn btn-warning">Imfeelinglucky</button>

<div class="results_of_game"></div>
<br>
<button type="button" class="history_button btn btn-primary">History</button>
<br>
<div class="linkBoard">
    <button type="button" class="create btn btn-success">Create new link</button>
    <a href="{{ route('link.deactivate', $uuid) }}"><button type="button" class="deactivate btn btn-danger">Deactivate this link</button></a>
</div>
<div class="newLink"></div>


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

                if (response.status === 'error ') {
                    htmlContent = `
                        <h2>${ response.message }</h2>
                    `;
                } else {
                    htmlContent = `
                        <div>
                        <h2>${response.data.result ? "Win" : "Lose"}</h2>
                        <br>
                        <p>Your score: ${response.data.score}</p>
                        <p>Your profit: ${response.data.sumOfWin}</p>
                        </div>
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

                if (response.status === 'error ') {
                    htmlContent = `
                        <h2>${ response.message }</h2>
                    `;
                } else {
                    for(let i = 0; i <= response.data.length - 1; i++)
                    {
                        const rawDate = response.data[i].created_at;
                        let formattedDate = new Date(rawDate).toISOString().split('T')[0];
                        let formattedTime = new Date(rawDate).toISOString().split('T')[1].split('.')[0];

                        htmlContent += (`
                            <div>
                            <br>
                            <h3>${response.data[i].result ? "Win" : "Lose"}</h3>
                            <p>Score: ${response.data[i].score}</p>
                            <p>Sum Of Win: ${response.data[i].sum_of_win}</p>
                            <p>Played in ${ formattedDate + " " + formattedTime }</p>
                            </div>
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

    $('.linkBoard').on('click', '.create', function() {
        $.ajax({
            url: '{{ route('link.create') }}',
            type: 'POST',
            data: {
                uuid: uuid,
            },
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            success: function (response) {
                if (response.status === 'error') {
                    $('.newLink').html(`<div>${response.message}</div>`);
                } else {
                    $('.newLink').html(`<div><a href="${response.data.link}" target="_blank" id="link">New link</a></div>`);
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
