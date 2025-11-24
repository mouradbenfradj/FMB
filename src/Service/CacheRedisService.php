<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Service de gestion du cache Redis avec invalidation centralisée.
 * Utilisé pour cacher les données métier et les invalider lors d'opérations CRUD.
 */
class CacheRedisService
{
    private CacheInterface $cache;
    private const PREFIX = 'asc:';

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Récupère une valeur du cache.
     *
     * @param string $key Clé du cache (ex: "filiere:1", "parcs:list")
     * @param callable|null $generator Fonction pour générer la valeur si absent
     * @return mixed
     */
    public function get(string $key, ?callable $generator = null): mixed
    {
        $cacheKey = self::PREFIX . $key;

        if ($generator === null) {
            return $this->cache->getItem($cacheKey)->get();
        }

        $item = $this->cache->getItem($cacheKey);
        if (!$item->isHit()) {
            $value = $generator();
            $item->set($value);
            $this->cache->save($item);
        }
        return $item->get();
    }

    /**
     * Stocke une valeur dans le cache.
     *
     * @param string $key Clé du cache
     * @param mixed $value Valeur à cacher
     * @param int|null $expiresAfter TTL en secondes (ex: 3600 pour 1h)
     */
    public function set(string $key, mixed $value, ?int $expiresAfter = 3600): void
    {
        $cacheKey = self::PREFIX . $key;
        $item = $this->cache->getItem($cacheKey);
        $item->set($value);
        if ($expiresAfter !== null) {
            $item->expiresAfter($expiresAfter);
        }
        $this->cache->save($item);
    }

    /**
     * Invalide une ou plusieurs clés du cache.
     *
     * @param string|array $keys Clé(s) à invalider (ex: "filiere:1" ou ["filiere:1", "parcs:list"])
     */
    public function invalidate(string|array $keys): void
    {
        $keys = (array) $keys;
        foreach ($keys as $key) {
            $cacheKey = self::PREFIX . $key;
            $this->cache->deleteItem($cacheKey);
        }
    }

    /**
     * Invalide toutes les clés commençant par un préfixe donné.
     * Utile pour invalider en masse (ex: toutes les filieres)
     *
     * @param string $prefix Préfixe à invalider (ex: "filiere:" pour invalider "filiere:1", "filiere:2", etc.)
     */
    public function invalidateByPrefix(string $prefix): void
    {
        // Note: Redis ne supporte pas nativement la suppression par pattern avec le pool abstrait Symfony.
        // Cette méthode peut être améliorée si vous avez accès direct au client Redis.
        // Pour l'instant, les callers doivent passer les clés explicitement.
        // Alternative: utiliser RedisAdapter directement et appeler $client->getOptions()
    }

    /**
     * Vide complètement le cache.
     */
    public function clear(): void
    {
        $this->cache->clear();
    }
}
