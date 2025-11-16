# Statistiques des Cordes - Documentation

## 📊 Vue d'ensemble

Ce système affiche dynamiquement les statistiques des `StockCorde` sur la page d'accueil, filtrées par parc sélectionné.

## 🎯 Statistiques Implémentées

### **Bloc 1 - "Cordes Préparées à sec"**
**Critères** : `pret = false` AND `emplacement = null` AND `dateDeMiseAEau = null`

**Méthode** : `StockCordeRepository::countCordesPreparteesASec(?int $parcId)`

**Sous-compteurs** (collapse) :
- Poches Préparées *(non implémenté - valeur statique 0)*
- Cordes Assemblées Préparées *(non implémenté - valeur statique 0)*

---

### **Bloc 2 - "Cordes à l'eau"**
**Critères** : `pret = false` AND `emplacement != null` AND `dateDeMiseAEau != null`

**Méthode** : `StockCordeRepository::countCordesALeau(?int $parcId)`

**Sous-compteurs** (collapse) :
- Lanternes vides *(non implémenté - valeur statique 0)*
- Cordes Assemblées à l'eau *(non implémenté - valeur statique 0)*

---

### **Bloc 3 - "Cordes vides"**
**Critères** : `stockArticleSn = null`

**Méthode** : `StockCordeRepository::countCordesVides(?int $parcId)`

**Sous-compteurs** (collapse) :
- **Cordes Huîtres à l'eau** : `pret = false` AND `emplacement != null` AND `dateDeMiseAEau != null` AND `corde.fruitDeMer.nom = 'Huître'`
  - Méthode : `StockCordeRepository::countCordesHuitresALeau(?int $parcId)`

- **Cordes Moules à l'eau** : `pret = false` AND `emplacement != null` AND `dateDeMiseAEau != null` AND `corde.fruitDeMer.nom = 'Moule'`
  - Méthode : `StockCordeRepository::countCordesMoulesALeau(?int $parcId)`

- **Chaussettes Cordes à l'eau** : `chaussement = true`
  - Méthode : `StockCordeRepository::countChaussettesCordesALeau(?int $parcId)`

---

### **Bloc 4 - "Total Cordes"**
**Critères** : `pret = false`

**Méthode** : `StockCordeRepository::countTotalCordes(?int $parcId)`

**Sous-compteurs** (collapse) :
- **Cordes Moules Préparées** : `pret = false` AND `emplacement = null` AND `corde.fruitDeMer.nom = 'Moule'`
  - Méthode : `StockCordeRepository::countCordesMoulesPreparees(?int $parcId)`

- **Cordes Huîtres Préparées** : `pret = false` AND `emplacement = null` AND `corde.fruitDeMer.nom = 'Huître'`
  - Méthode : `StockCordeRepository::countCordesHuitresPreparees(?int $parcId)`

---

## 🔧 Architecture

### **1. Repository - StockCordeRepository.php**

Toutes les méthodes de comptage suivent le même pattern :

```php
public function countXXX(?int $parcId = null): int
{
    $qb = $this->createQueryBuilder('sc')
        ->select('COUNT(sc.id)')
        ->where(/* critères spécifiques */);

    // Filtre optionnel par parc
    if ($parcId !== null) {
        $qb->leftJoin('sc.emplacement', 'e')
            ->leftJoin('e.segment', 's')
            ->leftJoin('s.filiere', 'f')
            ->andWhere('f.parc = :parcId')
            ->setParameter('parcId', $parcId);
    }

    return (int) $qb->getQuery()->getSingleScalarResult();
}
```

**Relations utilisées pour le filtre parc** :
```
StockCorde → Emplacement → Segment → Filiere → Parc
```

### **2. Controller - HomeController.php**

```php
#[Route('/', name: 'app_home')]
public function index(Request $request, StockCordeRepository $stockCordeRepo): Response
{
    // Récupération du parc sélectionné
    $parcId = $request->query->get('parc') ?? $request->getSession()->get('selected_parc_id');

    // Calcul de toutes les statistiques
    $stats = [
        'cordes_preparees_a_sec' => $stockCordeRepo->countCordesPreparteesASec($parcId),
        'cordes_a_leau' => $stockCordeRepo->countCordesALeau($parcId),
        'cordes_vides' => $stockCordeRepo->countCordesVides($parcId),
        'total_cordes' => $stockCordeRepo->countTotalCordes($parcId),
        'cordes_huitres_a_leau' => $stockCordeRepo->countCordesHuitresALeau($parcId),
        'cordes_moules_a_leau' => $stockCordeRepo->countCordesMoulesALeau($parcId),
        'chaussettes_cordes_a_leau' => $stockCordeRepo->countChaussettesCordesALeau($parcId),
        'cordes_moules_preparees' => $stockCordeRepo->countCordesMoulesPreparees($parcId),
        'cordes_huitres_preparees' => $stockCordeRepo->countCordesHuitresPreparees($parcId),
    ];

    return $this->render('home/index.html.twig', ['stats' => $stats]);
}
```

### **3. Template - templates/home/index.html.twig**

```twig
{# Bloc 1 - Cordes Préparées à sec #}
{% include 'home/_roundedCircleCounterUp.html.twig' with {
    titre: 'Cordes</br>Préparées â sec',
    value: stats.cordes_preparees_a_sec,
    icon: 'fe-more-vertical',
    niveau: 'info'
} %}

{# Bloc 2 - Cordes à l'eau #}
{% include 'home/_roundedCircleCounterUp.html.twig' with {
    titre: 'Cordes</br>à l\'eau',
    value: stats.cordes_a_leau,
    icon: 'fe-more-vertical',
    niveau: 'info'
} %}

{# ... etc #}
```

---

## 📝 Champs utilisés dans StockCorde

| Champ | Type | Nullable | Description |
|-------|------|----------|-------------|
| `pret` | bool | Non | Indique si la corde est prête |
| `emplacement` | ManyToOne | Oui | Relation vers Emplacement |
| `dateDeMiseAEau` | DATE | Oui | Date de mise à l'eau |
| `stockArticleSn` | ManyToOne | Non | Relation vers StockArticleSn |
| `chaussement` | bool | Non | Indique si c'est une chaussette |
| `corde` | ManyToOne | Non | Relation vers Corde |

---

## 🔗 Relations de filtrage par Parc

```
StockCorde
  └─ emplacement (nullable)
       └─ segment
            └─ filiere
                 └─ parc
```

**Note** : Si `emplacement` est `null`, le filtre par parc ne peut pas s'appliquer (cordes en stock, hors filière).

---

## 🎨 Interface utilisateur

### Structure des blocs
Chaque bloc statistique suit cette structure :

```html
<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <!-- Titre principal avec valeur -->
            <h5 class="card-title mb-0">
                {% include '_roundedCircleCounterUp.html.twig' with { ... } %}
            </h5>
            
            <!-- Sous-compteurs (collapse) -->
            <div id="cardCollpaseXX" class="collapse pt-3">
                {% include '_roundedCircleCounterUp.html.twig' with { ... } %}
                {% include '_roundedCircleCounterUp.html.twig' with { ... } %}
            </div>
        </div>
    </div>
</div>
```

### Animation
Le composant `_roundedCircleCounterUp.html.twig` utilise un contrôleur Stimulus `animated-number` pour animer le comptage des valeurs.

---

## 🧪 Test avec les fixtures

Après le chargement des fixtures (7 StockCorde), vous devriez voir :

- **Cordes préparées à sec** : Nombre de cordes avec `emplacement = null` et `dateDeMiseAEau = null`
- **Cordes à l'eau** : Nombre de cordes avec `emplacement != null` et `dateDeMiseAEau != null`
- **Cordes vides** : Actuellement 0 (fixtures ont toutes `stockArticleSn`)
- **Total cordes** : 7 (si toutes ont `pret = false`)

### Vérification SQL

```sql
-- Cordes préparées à sec
SELECT COUNT(*) FROM stock_corde 
WHERE pret = 0 AND emplacement_id IS NULL AND date_de_mise_aeau IS NULL;

-- Cordes à l'eau
SELECT COUNT(*) FROM stock_corde 
WHERE pret = 0 AND emplacement_id IS NOT NULL AND date_de_mise_aeau IS NOT NULL;

-- Cordes vides
SELECT COUNT(*) FROM stock_corde WHERE stock_article_sn_id IS NULL;

-- Total cordes
SELECT COUNT(*) FROM stock_corde WHERE pret = 0;

-- Cordes huîtres à l'eau
SELECT COUNT(*) 
FROM stock_corde sc
JOIN corde c ON sc.corde_id = c.id
JOIN fruit_de_mer fdm ON c.fruit_de_mer_id = fdm.id
WHERE sc.pret = 0 
  AND sc.emplacement_id IS NOT NULL 
  AND sc.date_de_mise_aeau IS NOT NULL
  AND fdm.nom = 'Huître';
```

---

## ⚠️ Points d'attention

1. **Fixtures** : Les StockCorde dans les fixtures doivent avoir des relations correctes avec `Corde` et `FruitDeMer` pour que les comptages par type fonctionnent.

2. **Filtre par parc** : Si une corde n'a pas d'`emplacement`, elle ne sera pas comptée dans les statistiques d'un parc spécifique (filtre `parcId != null`).

3. **Valeurs non implémentées** : Les sous-compteurs "Poches Préparées", "Lanternes vides", "Cordes Assemblées" affichent toujours 0 car non implémentés.

4. **Case sensitivity** : Les noms de fruits de mer dans la base doivent correspondre exactement à `'Huître'` et `'Moule'` (avec accents).

---

## 🚀 Utilisation

### Sans filtre de parc
```
GET /
```
Affiche les statistiques pour TOUTES les cordes, tous parcs confondus.

### Avec filtre de parc
```
GET /?parc=1
```
Affiche uniquement les statistiques des cordes liées au parc ID 1.

### Via session
Le parc peut aussi être stocké en session :
```php
$request->getSession()->set('selected_parc_id', 1);
```

---

## 📚 Méthodes disponibles dans StockCordeRepository

| Méthode | Critères | Retour |
|---------|----------|--------|
| `countCordesPreparteesASec(?int $parcId)` | `pret=false, emplacement=null, dateDeMiseAEau=null` | int |
| `countCordesALeau(?int $parcId)` | `pret=false, emplacement!=null, dateDeMiseAEau!=null` | int |
| `countCordesVides(?int $parcId)` | `stockArticleSn=null` | int |
| `countTotalCordes(?int $parcId)` | `pret=false` | int |
| `countCordesHuitresALeau(?int $parcId)` | Cordes à l'eau + fruit='Huître' | int |
| `countCordesMoulesALeau(?int $parcId)` | Cordes à l'eau + fruit='Moule' | int |
| `countChaussettesCordesALeau(?int $parcId)` | `chaussement=true` | int |
| `countCordesMoulesPreparees(?int $parcId)` | Préparées + fruit='Moule' | int |
| `countCordesHuitresPreparees(?int $parcId)` | Préparées + fruit='Huître' | int |

Toutes les méthodes acceptent `null` pour `$parcId`, ce qui désactive le filtre par parc.
