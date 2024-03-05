<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>FPS</title>

    <link href="style.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid min-vh-100">
    <div class="row min-vh-100">
        <div class="position-absolute p-3 text-center">
            <img class="col-3 img-fluid" style="opacity: 0.8" src="src/public/assets/logo.png" alt="logo">
        </div>
        <div class="position-absolute p-5 container text-end">
            <img class="col-2 img-fluid compas" style="background: white; opacity: 0.3; border-radius: 20px; rotate:"
                 src="src/public/assets/compass.png" alt="logo">
        </div>
        <img class="col img-fluid p-0 m-0 fps" src="src/public/images/01-0.jpg" alt="image">
        <input class="x" type="hidden" value="0">
        <input class="y" type="hidden" value="0">
        <input class="a" type="hidden" value="0">
        <div class="position-absolute bottom-0 start-50 translate-middle-x text-center card border-dark mb-3"
             style="max-width: 25rem; opacity: 40%">
            <div class="h2 card-body textBlock">
                <h5 class="card-title">Cela fait peur à mort</h5>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>