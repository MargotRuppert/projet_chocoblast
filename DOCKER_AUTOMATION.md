# 🚀 Automatisation de la création de la Base de Données

## Comment ça fonctionne ?

La création de la base de données est **entièrement automatisée** avec Docker. Voici le processus :

### 1️⃣ **Démarrage automatique**
Lors du premier lancement des conteneurs avec `docker compose up -d`, Docker détecte un volume vierge et exécute les scripts d'initialisation.

### 2️⃣ **Étapes d'initialisation MySQL**

1. **Variables d'environnement** (`.env`) :
   - `MYSQL_ROOT_PASSWORD` : Mot de passe root
   - `MYSQL_DATABASE` : Crée la base `chocoblast`
   - `MYSQL_USER` : Crée l'utilisateur `app_user`
   - `MYSQL_PASSWORD` : Définit le mot de passe

2. **Montage du fichier SQL** :
   - Le fichier `db.sql` est monté dans `/docker-entrypoint-initdb.d/01-db.sql`
   - Docker exécute automatiquement tous les fichiers `.sql` dans ce répertoire

3. **Fichier `db.sql`** :
   - Crée les 4 tables : `users`, `chocoblast`, `note`, `commentary`
   - Crée les contraintes de clés étrangères
   - Utilise `IF NOT EXISTS` pour éviter les erreurs

## 🔄 Flux d'initialisation

```
docker compose up -d
    ↓
Volume MySQL vierge détecté
    ↓
MySQL démarre
    ↓
Docker exécute les scripts dans /docker-entrypoint-initdb.d/
    ↓
① db.sql crée tables + contraintes
    ↓
Base de données prête ✅
```

## 📋 Points importants

### ✅ Ce qui est automatisé :
- Création de la base de données `chocoblast`
- Création de l'utilisateur `app_user`
- Création de toutes les tables
- Création des contraintes de clés étrangères
- Définition des permissions

### ⚠️ Points clés du fichier `db.sql` :
```sql
-- N'inclut PAS : CREATE DATABASE (créée par Docker)
-- Inclut : CREATE TABLE IF NOT EXISTS ...
-- Utilise : IF NOT EXISTS pour éviter les doublons
```

## 🔧 Modifier la structure de la BDD

Pour modifier la structure initiale :

1. **Éditez** `db.sql` avec vos modifications
2. **Supprimez** le volume existant :
   ```bash
   docker compose down -v
   ```
3. **Redémarrez** :
   ```bash
   docker compose up -d
   ```

> ⚠️ `docker compose down -v` supprime TOUTES les données !

## 📂 Fichiers importants

| Fichier | Rôle |
|---------|------|
| `.env` | Variables d'environnement pour Docker |
| `db.sql` | Script SQL d'initialisation |
| `docker-compose.yml` | Configuration des services |
| `Dockerfile.php` | Image PHP 8.2 |

## 🎯 Résultat final

Après `docker compose up -d`, vous avez :
- ✅ Base de données `chocoblast` prête
- ✅ 4 tables peuplées de structure
- ✅ Utilisateur `app_user` avec permissions
- ✅ Application accessible sur http://localhost:8000

Aucune action manuelle n'est nécessaire ! 🎉