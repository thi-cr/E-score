$(document).ready(function() {
    console.log('ready!');
    $('#equipes').on('click', function() {
        $.get('/equipes/index', function() {

        })
        .done(function (result){
            $('.equipes').html(result);
        })

        .fail(function(error) {
            console.log('error', error);
        });
    });
    $('#matchs').on('click', function() {
        $.get('/matchs/index', function() {

        })
            .done(function (result){
                $('.matchs').html(result);
            })

            .fail(function(error) {
                console.log('error', error);
            });
    });

    $('body').on('submit','#inscription', function (event) {
        $.post($(this).attr('action'))
            .done(function (resultat) {
                console.log($(resultat))
            })
    })


    $("select").mousedown(function(e){
        e.preventDefault();

        var select = this;
        var scroll = select.scrollTop;

        e.target.selected = !e.target.selected;

        setTimeout(function(){select.scrollTop = scroll;}, 0);

        $(select).focus();
    }).mousemove(function(e){e.preventDefault()});


});