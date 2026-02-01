<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bouton avec animation done</title>
<style>
/* Style du bouton */
.button {
  position: relative;
  padding: 12px 25px;
  font-size: 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  overflow: hidden;
  transition: background-color 0.3s;
}

.button:hover {
  background-color: #45a049;
}

/* Style pour l'animation "done" */
.done-icon {
  position: absolute;
  font-size: 20px;
  color: white;
  opacity: 0;
  transform: translate(0, 0) scale(0);
  pointer-events: none;
  transition: none;
  animation: none;
}

/* Animation cléframes */
@keyframes doneMove {
  0% {
    transform: translate(0, 0) scale(0);
    opacity: 0;
  }
  30% {
    transform: translate(0, -20px) scale(1.2);
    opacity: 1;
  }
  60% {
    transform: translate(0, -40px) scale(1);
    opacity: 1;
  }
  100% {
    transform: translate(20px, -60px) scale(0);
    opacity: 0;
  }
}
</style>
</head>
<body>

<button class="button" id="myButton">
  Envoyer
</button>

<script>
const btn = document.getElementById('myButton');

btn.addEventListener('click', () => {
  // Créer un élément pour l'animation
  const icon = document.createElement('span');
  icon.className = 'done-icon';
  icon.textContent = '✅';
  
  // Positionner aléatoirement par rapport au bouton
  const rect = btn.getBoundingClientRect();
  icon.style.left = `${Math.random() * rect.width}px`;
  icon.style.top = `${Math.random() * rect.height}px`;
  
  btn.appendChild(icon);
  
  // Lancer l'animation
  icon.style.animation = 'doneMove 1s ease forwards';
  
  // Supprimer l'icône après animation
  icon.addEventListener('animationend', () => {
    icon.remove();
  });
});
</script>

</body>
</html>
