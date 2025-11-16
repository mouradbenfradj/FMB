# TODO: Migrer vers Yarn packages

## Étape 1: Ajouter les dépendances manquantes
- [x] Ajouter apexcharts
- [x] Ajouter chart.js
- [x] Ajouter datatables.net et extensions
- [x] Ajouter moment
- [x] Ajouter d'autres bibliothèques nécessaires

## Étape 2: Modifier les imports dans les fichiers JS
- [x] assets/app.js : remplacer './libs/footable/...' par 'footable'
- [x] assets/etat_actuel_prod.js : remplacer './libs/footable/...' par 'footable'
- [ ] assets/commune.js : ajouter les imports manquants si nécessaire

## Étape 3: Supprimer les fichiers locaux inutiles
- [x] Supprimer assets/libs/footable/ après vérification
- [ ] Supprimer autres dossiers libs/ si remplacés

## Étape 4: Tester la compilation et le rendu
- [x] Compiler avec yarn build
- [ ] Vérifier que le rendu visuel est identique
- [ ] Vérifier que les interactions fonctionnent
