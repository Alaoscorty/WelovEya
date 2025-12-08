# TODO: Rendre le code responsive et faire fonctionner le chat en ligne

## Étapes à suivre

- [ ] Configurer le broadcasting avec Pusher dans config/broadcasting.php
- [ ] Rendre la vue direct.blade.php responsive (layout chat/vidéo)
- [ ] Rendre la vue index.blade.php responsive (carousel, sections)
- [ ] Ajouter des media queries dans public/css/styles.css pour responsive
- [ ] Corriger les bugs JavaScript dans public/js/script.js si nécessaire
- [ ] Tester le chat en lançant le serveur Laravel
- [ ] Vérifier la fonctionnalité sur différents appareils

## Notes
- Utiliser Pusher pour le broadcasting en temps réel
- Adapter les classes Tailwind pour mobile (flex-col, tailles ajustées)
- Assurer compatibilité avec les navigateurs mobiles
Maintenant fait moi la partie direct en ligne qui est dans la même section que vidéo en ligne de sorte que , lorsque l'utilisateur achète un tickets sur le site on lui donne un code secret qui lui permettra d'avoir accès au live en direct depuis l'iframe de youtube . Une fois qu'il clique sur le bouton suivre en ligne, un popup va s'aouvrir lui demandant d'enter son code secret. Si le code est correct il sera redirigé vers le live dans le cas contraire on lui envoie un message d'erreur dans une div afin qu'il tape à nouveau
-Gérer maintenant le backend de tous les fichiers du dashboard en prenant connaissance du code et en gérant également les pages de connexions et d'inscription, les details.De plus je veux que gère le fonctionnement du chat en ligne de sorte que les utilisateurs puissent discuter entre eux avec persistance des messages pendant 30 jours et en leur accordant un pseudonyme automatique à chacun