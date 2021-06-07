/*
$(document).ready(function () {
    console.log('hahahahahahahahahahahahahaha')
    $('body').on('submit','.deleteForm', function (event) {
        event.preventDefault();
        $.post($(this).attr('action'), {id: $(this).find('.deleteId').val()})
            .done(function (resultat) {
                console.log($(resultat))
                $('.big-container').html($(resultat).html())
            })
    })
})*/
