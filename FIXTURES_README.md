# Guide des DataFixtures du Projet ASC

## 📋 Résumé des Fixtures

### ✅ Entités avec Fixtures Complètes

| Entité | Fixture | Relations | Statut |
|--------|---------|-----------|--------|
| **Articles** | ArticlesFixtures | - | ✅ Complet |
| **Corde** | CordeFixtures | → FruitDeMer | ✅ Complet |
| **Emplacement** | *Auto-généré* | ← Segment (PrePersist) | ✅ Auto |
| **Filiere** | FiliereFixtures | → Parc | ✅ Complet |
| **Flotteur** | FlotteurFixtures | - | ✅ Complet |
| **FlotteurSegment** | *Dans SegmentFixtures* | → Segment, → Flotteur | ✅ Complet |
| **FruitDeMer** | FruitDeMerFixtures | - | ✅ Complet |
| **Lanterne** | LanterneFixtures | → FruitDeMer | ✅ Complet |
| **Parc** | ParcFixtures | - | ✅ Complet |
| **Phase** | PhaseFixtures | → Processus, → FruitDeMer | ✅ Complet |
| **Processus** | ProcessusFixtures | - | ✅ Complet |
| **Segment** | SegmentFixtures | → Filiere | ✅ Complet |
| **Stock** | StockFixtures | - | ✅ Complet |
| **StockArticle** | StockArticleFixtures | → Articles, → Stock | ✅ Complet |
| **StockArticleSn** | StockArticleSnFixtures | → StockArticle | ✅ Complet |
| **StockCorde** | StockCordeFixtures | → Corde, → StockArticleSn, → Emplacement | ✅ Amélioré |
| **StockLanterne** | StockLanterneFixtures | → Lanterne, → StockArticleSn, → Emplacement | ✅ Amélioré |
| **User** | UserFixtures | - | ✅ Complet |

## 🔄 Améliorations Récentes

### StockLanterneFixtures
**Avant :** Tous les emplacements étaient à `NULL`

**Après :**
- ✅ 4 lanternes connectées à des emplacements aléatoires
- ✅ 1 lanterne sans emplacement (pour tester le cas "en attente")
- ✅ Total : 5 fixtures au lieu de 3

**Code clé :**
```php
// Récupère des segments pour accéder aux emplacements
$segments = [];
for ($i = 0; $i < 20; $i++) {
    if ($this->hasReference("segment_$i")) {
        $segments[] = $this->getReference("segment_$i");
    }
}

// Assigne un emplacement aléatoire
if ($data['with_emplacement'] && count($segments) > 0) {
    $segment = $segments[array_rand($segments)];
    $emplacements = $segment->getEmplacements();
    if ($emplacements->count() > 0) {
        $emplacementIndex = rand(0, $emplacements->count() - 1);
        $emplacement = $emplacements->get($emplacementIndex);
        $stockLanterne->setEmplacement($emplacement);
    }
}
```

### StockCordeFixtures
**Avant :** 3 cordes avec emplacements

**Après :**
- ✅ 7 cordes avec emplacements aléatoires
- ✅ Variété de quantités (3-10)
- ✅ Variété de longueurs (18.75-30.00m)
- ✅ Avec et sans chaussement

## 🎯 Relations Automatiques

### Emplacement (Auto-généré)
Les emplacements sont créés automatiquement lors de la création d'un Segment grâce au callback `PrePersist` :

```php
#[ORM\PrePersist]
public function generateEmplacement()
{
    $place = 1;
    for ($i = 0; $i < ($this->longeur / $this->pasEmplacement); $i++) {
        $emplacement = new Emplacement();
        $emplacement->setPlace($place);
        $this->addEmplacement($emplacement);
        $place++;
        if ($place > 10) {
            $place = 1;
        }
    }
}
```

**Résultat :**
- Un segment de 125m avec `pasEmplacement=1` génère 125 emplacements
- Les places vont de 1 à 10 puis recommencent

### FlotteurSegment (Dans SegmentFixtures)
Les associations FlotteurSegment sont créées dans `SegmentFixtures` en fonction de la longueur du segment :

```php
$flotteursConfig = [
    'short' => ['flotteur_index' => 2, 'nombre' => 5, 'distanceDeDepart' => 1.0, 'pasFlotteur' => 3.0],   // 15m
    'medium' => ['flotteur_index' => 0, 'nombre' => 10, 'distanceDeDepart' => 2.0, 'pasFlotteur' => 10.0], // 30-100m
    'long' => ['flotteur_index' => 1, 'nombre' => 15, 'distanceDeDepart' => 3.0, 'pasFlotteur' => 8.0],    // 125-150m
    'xlong' => ['flotteur_index' => 3, 'nombre' => 25, 'distanceDeDepart' => 5.0, 'pasFlotteur' => 10.0],  // 200-250m
];
```

## 🔧 Charger les Fixtures

### Commande de base
```bash
php bin/console doctrine:fixtures:load
```

### Recharger en forçant
```bash
php bin/console doctrine:fixtures:load --no-interaction
```

### Ordre de chargement
Les fixtures respectent l'ordre des dépendances via `DependentFixtureInterface` :

1. **Entités de base** (sans dépendances)
   - FruitDeMer
   - Flotteur
   - Processus
   - Articles
   - Stock
   - Parc

2. **Entités avec 1 dépendance**
   - Corde (→ FruitDeMer)
   - Lanterne (→ FruitDeMer)
   - Phase (→ Processus, FruitDeMer)
   - StockArticle (→ Articles, Stock)
   - Filiere (→ Parc)

3. **Entités avec 2+ dépendances**
   - Segment (→ Filiere, Flotteur) + crée Emplacement + FlotteurSegment
   - StockArticleSn (→ StockArticle)
   - StockCorde (→ Segment, Corde, StockArticleSn)
   - StockLanterne (→ Segment, Lanterne, StockArticleSn)

## 📊 Statistiques des Données

Après chargement des fixtures :
- **Parcs** : 5
- **Filières** : 75+
- **Segments** : 130+
- **Emplacements** : ~7000+ (générés automatiquement)
- **FlotteurSegment** : 130+ (un par segment)
- **Flotteurs** : 5 types
- **Cordes** : 3 types
- **Lanternes** : 3 types
- **StockCorde** : 7 (connectés aux emplacements)
- **StockLanterne** : 5 (4 avec emplacements, 1 sans)
- **Articles** : 5
- **StockArticle** : 5
- **StockArticleSn** : 5

## 🎨 Personnalisation

Pour ajouter plus de données :

### Exemple : Ajouter des StockLanterne
```php
// Dans StockLanterneFixtures.php
[
    'lanterne_ref' => 'lanterne_3',
    'stockArticleSn_ref' => 'stockarticlesn_3',
    'pret' => true,
    'datedecreation' => new \DateTime('2023-06-01'),
    'dateDeMiseAEau' => new \DateTime('2023-06-15'),
    'with_emplacement' => true,
],
```

### Exemple : Ajouter des StockCorde
```php
// Dans StockCordeFixtures.php
[
    'corde_ref' => 'corde_1',
    'stockArticleSn_ref' => 'stockarticlesn_3',
    'quantite' => 12,
    'longueur' => 35.00,
    'pret' => true,
    'datedecreation' => new \DateTime('2024-05-01'),
    'chaussement' => true,
    'datechaussement' => new \DateTime('2024-05-10')
],
```

## ⚠️ Notes Importantes

1. **Cache Doctrine** : Après avoir chargé les fixtures, vider le cache :
   ```bash
   php bin/console cache:clear
   ```

2. **Base de données** : Les fixtures écrasent toutes les données existantes

3. **Emplacements** : Ne pas créer de fixtures manuelles pour Emplacement (auto-généré)

4. **FlotteurSegment** : Ne pas créer de fixtures séparées (géré dans SegmentFixtures)

5. **Références** : Utilisez `addReference()` pour créer des relations entre fixtures :
   ```php
   $this->addReference('segment_0', $segment);
   $segment = $this->getReference('segment_0', Segment::class);
   ```

## 🔍 Vérification

Après chargement, vérifier les données :

```bash
# Compter les segments
php bin/console dbal:run-sql "SELECT COUNT(*) FROM segment"

# Compter les emplacements
php bin/console dbal:run-sql "SELECT COUNT(*) FROM emplacement"

# StockLanterne avec emplacements
php bin/console dbal:run-sql "SELECT COUNT(*) FROM stock_lanterne WHERE emplacement_id IS NOT NULL"

# StockCorde avec emplacements
php bin/console dbal:run-sql "SELECT COUNT(*) FROM stock_corde WHERE emplacement_id IS NOT NULL"
```
