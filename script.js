document.addEventListener('keyup', (event) => {
    const key = ['w', 's', 'a', 'd', 'q', 'e', 'r']
    if (key.includes(event.key)) {
        $.ajax({
            type: 'GET',
            url: 'move.php',
            data: {key: event.key}
        }).done(function (msg) {
            // console.log(JSON.parse(msg).data)
            console.log(msg)

            $('.fps').attr('src', 'src/public/images/01-90.jpg')
        });
    }
})
// document.addEventListener('keyup', (event) => {
//     const key = ['w', 's', 'a', 'd', 'q', 'e', 'r']
//     if (key.includes(event.key)) {
//         $.ajax({
//             type: 'POST',
//             url: 'index.php',
//             data: {key: event.key}
//         }).done(function (msg) {
//             // console.log(JSON.parse(msg).data)
//             console.log(msg)
//
//             $('.fps').attr('src', 'src/public/images/01-90.jpg')
//         });
//     }
// })
