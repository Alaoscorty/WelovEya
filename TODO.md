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
Sur la page article gérer l'apparition du modal lorsqu'on clique sur le bouton ajouter une nouvelle article 
Sur la page article, faire en sorte que lorsqu'on clique sur le bouton "<button class="icon-button">
                                        <i class="fas fa-edit"></i>
                                    </button>" cela affiche un modal pour chaque produit contenant le div et son script "<div class="modal-container">
        <div class="modal-header">
            <h2>
                <i class="fas fa-pen-to-square"></i>
                Modifier l'article PROD-001
            </h2>
            <button class="close-btn" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="subtitle">
            Modifiez les informations sur votre article
        </div>

        <div class="form-section">
            <h3 class="section-title">Informations de base</h3>

            <form id="articleForm">
                <div class="form-group">
                    <label for="articleName">Nom de l'article</label>
                    <input type="text" id="articleName" value="T-shirt Logo Evenement" required>
                </div>

                <div class="form-group">
                    <label for="price">Prix de Vente</label>
                    <input type="text" id="price" value="10 000 FCFA" required>
                </div>

                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select id="category" required>
                        <option value="vetement" selected>Vêtement</option>
                        <option value="electronique">Électronique</option>
                        <option value="alimentaire">Alimentaire</option>
                        <option value="maison">Maison & Jardin</option>
                        <option value="sport">Sport</option>
                        <option value="livres">Livres</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" required>Ce T-shirt unisexe est l'édition officielle de notre événement annuel.</textarea>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-cancel" onclick="cancelForm()">
                        <i class="fas fa-times-circle"></i>
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-edit"></i>
                        Modifier l'article
                    </button>
                </div>
            </form>
        </div>
    </div>

    
 <script>
        const form = document.getElementById('articleForm');

        // Données initiales pour comparaison
        const initialData = {
            name: 'T-shirt Logo Evenement',
            price: '10 000 FCFA',
            category: 'vetement',
            description: 'Ce T-shirt unisexe est l\'édition officielle de notre événement annuel.'
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const articleData = {
                id: 'PROD-001',
                name: document.getElementById('articleName').value,
                price: document.getElementById('price').value,
                category: document.getElementById('category').value,
                description: document.getElementById('description').value
            };

            // Vérifier s'il y a des modifications
            const hasChanges = 
                articleData.name !== initialData.name ||
                articleData.price !== initialData.price ||
                articleData.category !== initialData.category ||
                articleData.description !== initialData.description;

            if (!hasChanges) {
                alert('Aucune modification détectée.');
                return;
            }

            console.log('Article modifié:', articleData);
            
            alert('✅ Article modifié avec succès!\n\n' + 
                  'ID: ' + articleData.id + '\n' +
                  'Nom: ' + articleData.name + '\n' +
                  'Prix: ' + articleData.price + '\n' +
                  'Catégorie: ' + articleData.category + '\n' +
                  'Description: ' + articleData.description);
            
            // Mettre à jour les données initiales
            Object.assign(initialData, {
                name: articleData.name,
                price: articleData.price,
                category: articleData.category,
                description: articleData.description
            });
        });

        function closeModal() {
            const currentData = {
                name: document.getElementById('articleName').value,
                price: document.getElementById('price').value,
                category: document.getElementById('category').value,
                description: document.getElementById('description').value
            };

            const hasChanges = 
                currentData.name !== initialData.name ||
                currentData.price !== initialData.price ||
                currentData.category !== initialData.category ||
                currentData.description !== initialData.description;

            if (hasChanges) {
                if (confirm('Vous avez des modifications non enregistrées. Voulez-vous vraiment fermer?')) {
                    window.close();
                }
            } else {
                window.close();
            }
        }

        function cancelForm() {
            const currentData = {
                name: document.getElementById('articleName').value,
                price: document.getElementById('price').value,
                category: document.getElementById('category').value,
                description: document.getElementById('description').value
            };

            const hasChanges = 
                currentData.name !== initialData.name ||
                currentData.price !== initialData.price ||
                currentData.category !== initialData.category ||
                currentData.description !== initialData.description;

            if (hasChanges) {
                if (confirm('Voulez-vous annuler les modifications? Les changements non enregistrés seront perdus.')) {
                    // Restaurer les valeurs initiales
                    document.getElementById('articleName').value = initialData.name;
                    document.getElementById('price').value = initialData.price;
                    document.getElementById('category').value = initialData.category;
                    document.getElementById('description').value = initialData.description;
                }
            } else {
                alert('Aucune modification à annuler.');
            }
        } 
        ""
        de sorte que lorsq'on clique sur le bouton les informations du div concerner s'affiche.