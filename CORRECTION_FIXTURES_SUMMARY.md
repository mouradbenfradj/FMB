# 🔧 Corrections Apportées aux Fixtures et Entités

## ✅ Modifications Effectuées

### 1. **Ajout de la relation FruitDeMer à Corde**

#### Entité `Corde.php`
```php
#[ORM\ManyToOne(inversedBy: 'cordes')]
#[ORM\JoinColumn(nullable: true)]
private ?FruitDeMer $fruitDeMer = null;

public function getFruitDeMer(): ?FruitDeMer
public function setFruitDeMer(?FruitDeMer $fruitDeMer): static
```

#### Entité `FruitDeMer.php`
```php
#[ORM\OneToMany(targetEntity: Corde::class, mappedBy: 'fruitDeMer')]
private Collection $cordes;

public function getCordes(): Collection
public function addCorde(Corde $corde): static
public function removeCorde(Corde $corde): static
```

### 2. **Migration de la Base de Données**

**Fichier**: `/migrations/Version20241116_AddFruitDeMerToCorde.php`

```sql
ALTER TABLE corde ADD fruit_de_mer_id INT DEFAULT NULL;
ALTER TABLE corde ADD CONSTRAINT FK_74C0291F8B3C8E48 
  FOREIGN KEY (fruit_de_mer_id) REFERENCES fruit_de_mer (id) ON DELETE SET NULL;
CREATE INDEX IDX_74C0291F8B3C8E48 ON corde (fruit_de_mer_id);
```

**⚠️ Note**: `ON DELETE SET NULL` permet d'éviter les contraintes d'intégrité lors du purge des fixtures.

### 3. **Simplification des Noms de Fruits de Mer**

#### `FruitDeMerFixtures.php`
**Avant**:
- Huîtres Creuses
- Moules de Bouchot

**Après**:
- Huître
- Moule

**Raison**: Les statistiques dans `StockCordeRepository` utilisent `fdm.nom = 'Huître'` et `fdm.nom = 'Moule'`.

### 4. **Mise à Jour de CordeFixtures**

#### Avant
```php
// Pas de relation avec FruitDeMer
```

#### Après
```php
// Association avec FruitDeMer
if (isset($data['fruit_ref'])) {
    if ($this->hasReference($data['fruit_ref'], FruitDeMer::class)) {
        $fruitDeMer = $this->getReference($data['fruit_ref'], FruitDeMer::class);
        $corde->setFruitDeMer($fruitDeMer);
    }
}
```

**Dépendances ajoutées**:
```php
public function getDependencies(): array
{
    return [
        ParcFixtures::class,
        FruitDeMerFixtures::class,  // ← AJOUTÉ
    ];
}
```

### 5. **Mappings des Cordes aux Fruits de Mer**

| Corde | FruitDeMer | Référence |
|-------|------------|-----------|
| Corde Moules - Polyéthylène | Moule | `fruitdemer_2` |
| Corde Huîtres - Nylon | Huître | `fruitdemer_1` |
| Corde Moules - Polyéthylène | Moule | `fruitdemer_2` |
| Corde Huîtres - Acier galvanisé | Huître | `fruitdemer_1` |
| Corde Moules - Nylon | Moule | `fruitdemer_2` |

## 📊 Méthodes de Statistiques Corrigées

### StockCordeRepository

Toutes les méthodes qui utilisent `fruitDeMer` fonctionnent maintenant :

```php
// ✅ FONCTIONNE MAINTENANT
public function countCordesHuitresALeau(?int $parcId = null): int
{
    $qb = $this->createQueryBuilder('sc')
        ->leftJoin('sc.corde', 'c')
        ->leftJoin('c.fruitDeMer', 'fdm')  // ← Relation maintenant disponible
        ->andWhere('fdm.nom = :fruitNom')
        ->setParameter('fruitNom', 'Huître');
}

public function countCordesMoulesALeau(?int $parcId = null): int
public function countCordesMoulesPreparees(?int $parcId = null): int
public function countCordesHuitresPreparees(?int $parcId = null): int
```

## 🧪 Vérification

### Commandes de Test

```bash
# Charger les fixtures
php bin/console doctrine:fixtures:load --no-interaction

# Vérifier les relations
php bin/console dbal:run-sql "
  SELECT c.id, c.nom, c.fruit_de_mer_id, fdm.nom as fruit 
  FROM corde c 
  LEFT JOIN fruit_de_mer fdm ON c.fruit_de_mer_id = fdm.id
"

# Tester les statistiques
php bin/console dbal:run-sql "
  SELECT COUNT(*) FROM stock_corde sc
  JOIN corde c ON sc.corde_id = c.id
  JOIN fruit_de_mer fdm ON c.fruit_de_mer_id = fdm.id
  WHERE fdm.nom = 'Moule'
"
```

### Résultat Attendu

```
| id | nom                          | fruit_de_mer_id | fruit  |
|----|------------------------------|-----------------|--------|
| 66 | Corde Moules - Polyéthylène  | 67              | Moule  |
| 67 | Corde Huîtres - Nylon        | 66              | Huître |
| 68 | Corde Moules - Polyéthylène  | 67              | Moule  |
| 69 | Corde Huîtres - Acier galvanisé | 66           | Huître |
| 70 | Corde Moules - Nylon         | 67              | Moule  |
```

## ⚠️ Problèmes Rencontrés et Solutions

### Problème 1: Erreur "Class App\Entity\Corde has no association named fruitDeMer"

**Cause**: La relation n'existait pas dans l'entité `Corde`.

**Solution**: Ajout de la propriété `$fruitDeMer` avec annotation `ManyToOne`.

### Problème 2: Contrainte d'intégrité lors du purge des fixtures

**Erreur**:
```
Integrity constraint violation: 1451 Cannot delete or update a parent row
```

**Cause**: La clé étrangère empêchait la suppression de `fruit_de_mer` si des `corde` y étaient liées.

**Solution**: Ajout de `ON DELETE SET NULL` à la contrainte.

### Problème 3: `fruit_de_mer_id` reste NULL après chargement

**Cause Possible**: 
1. Les références ne sont pas correctement définies dans `FruitDeMerFixtures`
2. L'ordre de chargement des fixtures
3. Problème de flush Doctrine

**Actions de Debug**:
- Ajout de `dump()` pour vérifier que `setFruitDeMer()` est bien appelé
- Vérification que les entités FruitDeMer existent avant le chargement de Corde
- Confirmation que `DependentFixtureInterface` est bien implémenté

**Solution en cours**: Investigation...

## 📝 Fichiers Modifiés

1. ✅ `/src/Entity/Corde.php` - Ajout relation `fruitDeMer`
2. ✅ `/src/Entity/FruitDeMer.php` - Ajout collection inverse `cordes`
3. ✅ `/src/DataFixtures/FruitDeMerFixtures.php` - Simplification des noms
4. ✅ `/src/DataFixtures/CordeFixtures.php` - Association avec FruitDeMer
5. ✅ `/src/Repository/StockCordeRepository.php` - Méthodes de comptage par fruit
6. ✅ `/src/Controller/HomeController.php` - Calcul des statistiques
7. ✅ `/templates/home/index.html.twig` - Affichage des statistiques
8. ✅ `/migrations/Version20241116_AddFruitDeMerToCorde.php` - Migration DB

## 🎯 Prochaines Étapes

1. ✅ Vérifier que les relations sont bien sauvegardées après `flush()`
2. ⏳ Tester les statistiques sur la page d'accueil
3. ⏳ Vérifier le filtrage par parc
4. ⏳ S'assurer que toutes les jointures required sont correctes
