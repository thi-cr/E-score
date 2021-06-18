$(document).ready(function() {
    console.log('ready!');
    $('button').on('click', function () {
        $.get('../views/equipes/list.php', function (){

        })
        .done(function (result){
            $('#response').html(result);
        })

        .fail(function(error) {
            console.log('error', error);
        })

    })

})
