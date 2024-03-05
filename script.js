document.addEventListener('keyup', (event) => {
    const key = ['w', 's', 'a', 'd', 'q', 'e', 'r']
    if (key.includes(event.key)) {
        let x = $('.x').val();
        let y = $('.y').val();
        let a = $('.a').val();

        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: {
                key: event.key,
                x: x,
                y: y,
                a: a
            }
        }).done(function (msg) {
            if (!msg['error']) {
                $('.fps').attr('src', 'src/public/' + msg['image'])
                $('.x').attr('value', msg['x']);
                $('.y').attr('value', msg['y']);
                $('.a').attr('value', msg['a']);
                if (msg['text'] === null) {
                    $('.textBlock').attr('hidden', 'hidden');
                } else {
                    $('.textBlock').removeAttr('hidden');
                    $('.textBlock').text(msg['text']);
                }
                $('.compas').css('rotate', msg['a'] + 'deg')
            } else {
            }
        });
    }
})
