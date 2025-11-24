# ✅ Corrections PHP - Xdebug et Memory Limit

## Problèmes Résolus

### 1. ❌ Erreur Xdebug

**Erreur précédente** :
```
Xdebug: [Step Debug] Could not connect to debugging client. 
Tried: localhost:9000 (through xdebug.client_host/xdebug.client_port)
```

**Solution** : Désactivation de Xdebug en mode debug

**Fichier** : `/usr/local/etc/php/conf.d/xdebug.ini`

```ini
zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20240924/xdebug.so
xdebug.mode = off
xdebug.start_with_request = no
```

### 2. ❌ Erreur Memory Limit

**Erreur précédente** :
```
Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 32768 bytes)
```

**Solution** : Augmentation de la limite mémoire à 512M

**Fichier** : `/usr/local/etc/php/conf.d/custom.ini`

```ini
memory_limit = 512M
max_execution_time = 300
```

## Vérification

```bash
# Vérifier la limite mémoire
php -r "echo 'Memory Limit: ' . ini_get('memory_limit') . PHP_EOL;"
# Résultat attendu : Memory Limit: 512M

# Vérifier que Xdebug n'affiche plus d'erreur
php bin/console about

# Tester le cache
php bin/console cache:clear
```

## Commandes Appliquées

```bash
# 1. Désactivation Xdebug
sudo bash -c 'cat > /usr/local/etc/php/conf.d/xdebug.ini << EOF
zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20240924/xdebug.so
xdebug.mode = off
xdebug.start_with_request = no
EOF'

# 2. Augmentation Memory Limit
sudo bash -c 'cat > /usr/local/etc/php/conf.d/custom.ini << EOF
memory_limit = 512M
max_execution_time = 300
EOF'

# 3. Nettoyage cache
php bin/console cache:clear
```

## Résultat

✅ **Plus d'erreur Xdebug** : Les commandes s'exécutent sans avertissement  
✅ **Plus d'erreur mémoire** : Limite passée de 128M à 512M  
✅ **Cache fonctionnel** : `cache:clear` fonctionne sans erreur

## Notes

- **Xdebug** : Désactivé en mode `off` mais toujours installé. Pour le réactiver :
  ```bash
  sudo sed -i 's/xdebug.mode = off/xdebug.mode = debug/' /usr/local/etc/php/conf.d/xdebug.ini
  ```

- **Memory Limit** : 512M devrait être suffisant. Si besoin d'augmenter :
  ```bash
  sudo sed -i 's/memory_limit = 512M/memory_limit = 1G/' /usr/local/etc/php/conf.d/custom.ini
  ```

## Impact sur le Projet

Toutes les commandes Symfony et Doctrine fonctionnent maintenant sans erreur :
- ✅ `doctrine:fixtures:load`
- ✅ `cache:clear`
- ✅ `doctrine:migrations:migrate`
- ✅ `doctrine:schema:update`
