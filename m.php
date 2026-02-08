<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zoom sur une partie de l'image</title>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #111;
    margin: 0;
  }

  .img-container {
    position: relative;
    width: 400px;
    height: 200px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid #fff;
  }

  .img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
    /* origine du zoom : centre de l'image, change selon la zone voulue */
    transform-origin: 30% 40%; 
  }

  .img-container:hover img {
    transform: scale(1.8); /* zoom sur la zone définie par transform-origin */
  }

  /* optionnel : focus en forme de cercle */
  .img-container::after {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    width: 120px;
    height: 120px;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    box-shadow: 0 0 50px 10px rgba(255,255,255,0.2);
    pointer-events: none;
  }

</style>
</head>
<body>

<div class="img-container">
  <img src="https://i.pinimg.com/1200x/66/19/cb/6619cbfae72d1702432b8629dfa69406.jpg" alt="Zoom sur partie">
</div>

</body>
</html>
