<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recherche d'Articles Asynchrone</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f0f0f0;
    padding: 20px;
  }

  h1 {
    text-align: center;
    color: #0001ad;
    margin-bottom: 20px;
  }

  .search-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
  }

  .search-bar input {
    width: 300px;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #0001ad;
    border-radius: 5px;
    outline: none;
  }

  .articles {
    max-width: 600px;
    margin: auto;
  }

  .article {
    background: white;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
  }

  .hidden {
    display: none;
  }
</style>
</head>
<body>

<h1>Recherche d'Articles</h1>

<div class="search-bar">
  <input type="text" id="searchInput" placeholder="Rechercher un article...">
</div>

<div class="articles">
  <div class="article">Comment apprendre le JavaScript facilement</div>
  <div class="article">10 astuces pour coder plus vite</div>
  <div class="article">Les meilleurs frameworks front-end en 2026</div>
  <div class="article">Créer un site web responsive</div>
  <div class="article">Optimiser le SEO de votre blog</div>
</div>

<script>
const input = document.getElementById('searchInput');
const articles = document.querySelectorAll('.article');

input.addEventListener('input', () => {
  const filter = input.value.toLowerCase();

  articles.forEach(article => {
    const text = article.textContent.toLowerCase();
    article.classList.toggle('hidden', !text.includes(filter));
  });
});
</script>

</body>
</html>
