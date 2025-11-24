# Guide d'utilisation du système de cache Redis

## Vue d'ensemble

Le projet utilise **Redis** pour mettre en cache les données métier critiques (Parcs, Filières, Segments). L'invalidation est **automatique** via un système d'event listeners Doctrine qui détecte les opérations CRUD et nettoie le cache en conséquence.

## Architecture

### 1. `CacheRedisService` — Gestionnaire centralisé

Fichier: `src/Service/CacheRedisService.php`

Service responsable de toutes les opérations de cache Redis. À injecter dans vos services/contrôleurs qui ont besoin d'accès au cache.

**Méthodes disponibles:**

```php
// Récupérer une valeur (avec générateur optionnel)
$value = $cacheService->get('filiere:1', fn() => $filiere);

// Stocker une valeur
$cacheService->set('filiere:1', $filiere, 3600); // TTL 1h

// Invalider une ou plusieurs clés
$cacheService->invalidate('filiere:1');
$cacheService->invalidate(['filiere:1', 'filiere:2', 'parcs:all']);

// Vider tout le cache
$cacheService->clear();
```

### 2. `CacheInvalidationListener` — Invalidation automatique

Fichier: `src/EventListener/CacheInvalidationListener.php`

Event listener Doctrine qui détecte les changements (`postPersist`, `postUpdate`, `postRemove`) et invalide automatiquement les clés concernées pour:
- **Filiere**: `filiere:{id}`, `filieres:all`, `parc:{id}:filieres`
- **Segment**: `segment:{id}`, `segments:all`, `filiere:{id}:segments`
- **Parc**: `parc:{id}`, `parcs:all`, `parcs:cache`

**Aucune action manuelle requise** — le listener fonctionne en arrière-plan.

### 3. `ParcCacheService` — Service métier optimisé

Fichier: `src/Service/ParcCacheService.php`

Service spécifique pour le cache des Parcs avec toutes leurs relations (Filières, Segments, Emplacements, etc.). Utilise `CacheRedisService` en interne.

```php
// Récupère tous les Parcs avec relations, en cache Redis
$allParcs = $parcCacheService->getAllParcsWithRelations();

// Cherche un Parc spécifique dans la liste en cache
$parc = $parcCacheService->getParcFromCache(1, $allParcs);

// Force l'invalidation du cache manuellement
$parcCacheService->refreshCache();
```

## Flux d'utilisation typique

### Scénario: Modifier une Filière via Sonata Admin

1. **User modifie et sauvegarde** une Filière dans `FiliereAdmin`
2. **Doctrine persiste** l'entité en base de données
3. **CacheInvalidationListener détecte** l'événement `postUpdate`
4. **Listener invalide** automatiquement:
   - `filiere:{id}`
   - `filieres:all`
   - `parc:{id}:filieres` (où `{id}` est le Parc parent)
5. **Le cache Redis** est nettoyé pour ces clés
6. **Prochain appel** à `$cacheService->get('filieres:all', ...)` recalcule les données fraîches

### Scénario: Ajouter un nouveau Segment

1. **User crée** un Segment depuis `SegmentAdmin`
2. **CacheInvalidationListener détecte** l'événement `postPersist`
3. **Listener invalide**:
   - `segments:all`
   - `filiere:{id}:segments` (Filière parent)
4. **Données fraîches** seront chargées à la prochaine requête

### Scénario: Supprimer un Parc

1. **User supprime** un Parc depuis `ParcAdmin`
2. **CacheInvalidationListener détecte** l'événement `postRemove`
3. **Listener invalide**:
   - `parc:{id}`
   - `parcs:all`
   - `parcs:cache`
4. **Cache nettoyé**, la liste des Parcs sera recalculée

## Configuration

### Redis

Redis est configuré dans `config/packages/cache.yaml`:

```yaml
framework:
    cache:
        pools:
            parcs.cache:
                adapter: cache.adapter.redis
                provider: 'redis://localhost'
```

**Variables d'environnement** (`.env*`):
```
REDIS_URL=redis://localhost:6379
```

### Conteneur Docker

Redis est lancé via `compose.yaml`. Pour démarrer:

```bash
cd asc
docker compose up -d
```

Vérifier que Redis fonctionne:
```bash
docker compose ps
# ou
redis-cli ping  # Devrait retourner PONG
```

## Bonnes pratiques

### ✅ À faire

- **Utiliser des clés préfixées cohérentes** (ex: `entity:id`, `entity:list`)
- **Spécifier un TTL approprié** (ex: 3600 pour 1h, None pour sans limite)
- **Laisser le listener gérer l'invalidation** — pas de `refreshCache()` manuel en conditions normales
- **Cacher les collections chargées** (requêtes LEFT JOIN coûteuses)

### ❌ À éviter

- **Mélanger les espaces de noms** (utiliser des clés claires et typées)
- **Oublier de lister toutes les clés dépendantes** quand on modifie le listener
- **Caché des données sensibles sans limiter le TTL** (sécurité)
- **Appeler `refreshCache()` en production** sans raison (CacheInvalidationListener gère tout)

## Exemple d'utilisation dans un contrôleur

```php
namespace App\Controller;

use App\Service\CacheRedisService;
use App\Repository\FiliereRepository;

class FiliereController
{
    public function list(CacheRedisService $cache, FiliereRepository $repo)
    {
        // Récupère la liste en cache, ou la génère si absent
        $filieres = $cache->get('filieres:all', fn() => $repo->findAll());
        
        return $this->render('filiere/list.html.twig', [
            'filieres' => $filieres,
        ]);
    }
}
```

## Troubleshooting

### Redis ne démarre pas

```bash
cd asc
docker compose logs database  # Ou service Redis si configuré
docker compose restart
```

### Cache ne semble pas fonctionner

1. Vérifier Redis tourne: `redis-cli ping`
2. Vérifier les logs: `docker compose logs`
3. Vider le cache manuellement:
   ```bash
   redis-cli FLUSHDB
   ```

### Clés cassées après refactorisation

Si vous modifiez les noms de clés, **videz Redis** et relancez:
```bash
redis-cli FLUSHDB
php bin/console cache:clear
```

## Prochaines améliorations possibles

- [ ] Ajouter invalidation par pattern (ex: `invalidateByPattern('filiere:*')`)
- [ ] Intégrer tags Symfony Cache pour grouper les clés
- [ ] Ajouter métriques (hits/misses) avec APM
- [ ] Synchroniser le cache entre plusieurs instances (pub/sub Redis)
