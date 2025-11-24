# Copilot / Agent instructions — Projet ASC (FMB)

Résumé rapide

- Projet principal: application Symfony (PHP 8.1+, Symfony 6.4) livrée dans le sous-dossier `asc/`.
- Frontend: Webpack Encore + Stimulus, sources dans `asc/assets/` et contrôleurs listés dans `asc/assets/controllers.json`.
- Admin: Sonata Admin (`src/Admin/*.php`) + entités Doctrine dans `src/Entity/`.
- Cache: Redis (`src/Service/CacheRedisService.php`) avec invalidation automatique (`src/EventListener/CacheInvalidationListener.php`).

Architecture et points d'entrée clés

- Symfony app: code dans `asc/` — point d'entrée `asc/public/index.php`, Kernel en `asc/src/Kernel.php`.
- Entités & logique métier: `asc/src/Entity/` ; repository dans `asc/src/Repository/` ; migrations dans `asc/migrations/`.
- Console & tâches: `asc/bin/console` (ou `php bin/console`) pour fixtures, migrations, assets:install, etc.
- Admin: classes Sonata dans `asc/src/Admin/` (ex: `FiliereAdmin.php` configure FormMapper, ListMapper, ShowMapper).
- Services métier: `asc/src/Service/` incluant `CacheRedisService` (gestion centralisée du cache Redis) et `ParcCacheService` (cache des Parcs avec relations).

Build / tests / debug (règles précises)

- Installer dépendances PHP: `cd asc && composer install`.
- Installer dépendances JS et builder: `cd asc && npm install` ou `yarn install`.
- Builder les assets (prod): `cd asc && yarn build` (ou `npm run build`).
- Développement assets: `cd asc && yarn dev` ou `npm run dev` ; serveur HMR: `yarn dev-server`.
- Tests unit / intégration: `cd asc && php bin/phpunit` (ou `./vendor/bin/phpunit` si nécessaire). Configuration: `asc/phpunit.xml.dist`.
- Base locale / containers: `cd asc && docker compose -f compose.yaml up -d` (lance MySQL + mailer, Redis configuré en `.env`).

Conventions et patterns spécifiques

- Code PHP utilise propriétés typées + attributs Doctrine (ex: `#[ORM\Column(...)]`).
- Getters booléens: souvent nommés `isXxx()` (ex: `isAireDeTravaille()` dans `src/Entity/Filiere.php`) — vérifier nom du getter attendu par les formulaires.
- Sonata Admin: forme les formulaires via `FormMapper` (ex: `->add('parc', EntityType::class, ...)`, `->add('segments', CollectionType::class, [], ['edit'=>'inline', ...])`). Pour modifier le comportement des relations, consulte `cascade: ['persist']` et les méthodes `addX/removeX` dans l'entité.
- Stimulus + Turbo: contrôleurs JS dans `assets/controllers.json`. `webpack.config.js` active `enableStimulusBridge()`.
- **Cache Redis**: voir `docs/CACHE_REDIS_GUIDE.md`. Usage: `$cacheService->get('key', fn() => $value)`, `$cacheService->invalidate(['key1', 'key2'])`. Invalidation automatique via `CacheInvalidationListener` lors de postPersist/postUpdate/postRemove — aucune action manuelle en conditions normales.

Intégrations et opérations sensibles

- API Platform est installé (paquet `api-platform/*`) — si tu modifies les entités, vérifie l'impact sur les ressources API.
- Migrations: utiliser `php bin/console doctrine:migrations:migrate` (attention aux environnements). Les migrations se trouvent dans `asc/migrations/`.
- Déploiement CI: `.github/workflows/main.yml` construit les assets avec Yarn et déploie via FTP; il crée un `.env.local` prod et appelle `database_install.php` à la fin — manipule ces étapes avec précaution (ne pas exposer de secrets dans le code).
- **Redis en prod**: `.env.prod` et workflow CI doivent configurer `REDIS_URL` pointant vers l'instance Redis de production.

Où commencer pour tâches courantes (exemples pratiques)

- Modifier un formulaire Sonata: inspecter `asc/src/Admin/<Entity>Admin.php` (FormMapper), puis `asc/src/Entity/<Entity>.php` pour les getters/setters et les annotations/attributs.
- Ajouter un champ JS: mettre à jour `asc/assets/*`, puis `yarn build` et vérifier le fichier généré dans `asc/public/build/`.
- Reproduire un bug DB local: lancer `cd asc && docker compose -f compose.yaml up -d` puis `php bin/console doctrine:fixtures:load` si besoin.
- **Mettre en cache une requête**: injecter `CacheRedisService`, utiliser `$cache->get('key', fn() => $repo->findAll())`, CacheInvalidationListener invalidera automatiquement lors de modifications.
- **Ajouter une entité au cache**: ajouter le mappage dans `CacheInvalidationListener.php` pour déterminer quelles clés invalider lors de CRUD.

Fichiers à lire en priorité

- `asc/composer.json`, `asc/package.json`, `asc/webpack.config.js`
- `asc/src/Kernel.php`, `asc/public/index.php`
- `asc/src/Admin/` (Sonata) et `asc/src/Entity/`
- `asc/src/Service/CacheRedisService.php`, `asc/src/EventListener/CacheInvalidationListener.php`
- `asc/phpunit.xml.dist`, `asc/migrations/`, `asc/compose.yaml`, `asc/config/packages/cache.yaml`
- **Nouveau**: `asc/docs/CACHE_REDIS_GUIDE.md` — guide complet du système de cache

Restrictions & hypothèses

- N'interprète pas de comportements non présents dans le code (ex: configuration Redis/queue non déclarée ici doit être vérifiée dans `config/packages/` avant de l'utiliser).
- Le projet est organisé dans le sous-dossier `asc/` — toute commande doit être relative à ce dossier.
- Redis doit tourner pour que le cache fonctionne — en local, lancer `docker compose up -d` d'abord.
