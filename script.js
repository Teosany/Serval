document.addEventListener('keypress', (event) => {
    const key = ['KeyW', 'KeyS', 'KeyA', 'KeyD', 'KeyQ', 'KeyE', 'KeyR']
    if (key.includes(event.code)) {
        let x = $('.x').val();
        let y = $('.y').val();
        let a = $('.a').val();
        let status = $('.status').val();

        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: {
                key: event.code,
                x: Number(x),
                y: Number(y),
                a: Number(a),
                status: Number(status)
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
            }
        });
    }
})