# Guide de Test des Middlewares

## Test du système de protection des accès

### 1. Test avec un compte Élève

**Scénario :** Un élève essaie d'accéder à la page professeur

**Étapes :**
1. Connectez-vous avec un compte élève
2. Essayez d'accéder directement à l'URL : `/pageprof`
3. **Résultat attendu :** Redirection vers `/pageeleve` avec le message "Accès réservé aux professeurs."

**Test dans le navigateur :**
```
http://votre-site.com/pageprof
```

### 2. Test avec un compte Professeur

**Scénario :** Un professeur essaie d'accéder à la page admin

**Étapes :**
1. Connectez-vous avec un compte professeur
2. Essayez d'accéder directement à l'URL : `/pageadmin`
3. **Résultat attendu :** Redirection vers `/pageprof` avec le message "Accès réservé aux administrateurs."

### 3. Test avec un compte Admin

**Scénario :** Un admin essaie d'accéder à la page élève

**Étapes :**
1. Connectez-vous avec un compte admin
2. Essayez d'accéder directement à l'URL : `/pageeleve`
3. **Résultat attendu :** Redirection vers `/pageadmin` avec le message "Accès réservé aux élèves."

### 4. Test de redirection automatique

**Scénario :** Un utilisateur connecté visite la page d'accueil

**Étapes :**
1. Connectez-vous avec n'importe quel compte
2. Allez sur la page d'accueil : `/`
3. **Résultat attendu :** Redirection automatique vers la page appropriée selon le rôle

### 5. Test d'accès non autorisé

**Scénario :** Un utilisateur non connecté essaie d'accéder à une page protégée

**Étapes :**
1. Déconnectez-vous
2. Essayez d'accéder à `/pageadmin`, `/pageprof`, ou `/pageeleve`
3. **Résultat attendu :** Redirection vers `/login` avec le message "Vous devez être connecté pour accéder à cette page."

## Vérification des messages d'erreur

Les messages suivants doivent s'afficher dans les cas appropriés :

- ✅ "Vous devez être connecté pour accéder à cette page."
- ✅ "Accès réservé aux administrateurs."
- ✅ "Accès réservé aux professeurs."
- ✅ "Accès réservé aux élèves."

## Test des routes protégées

### Routes Admin uniquement :
- `/pageadmin` ✅
- `/dashboard` ✅
- `/admin/users` ✅

### Routes Professeur uniquement :
- `/pageprof` ✅

### Routes Élève uniquement :
- `/pageeleve` ✅

### Routes publiques (avec redirection automatique) :
- `/` ✅
- `/visualisation` ✅
- `/quizz` ✅
- `/faq` ✅
- `/simulation` ✅
- `/recherche` ✅

## Commandes pour tester

```bash
# Vider le cache des routes
php artisan route:clear

# Lister toutes les routes pour vérifier
php artisan route:list

# Tester une route spécifique
php artisan route:list --name=pageadmin
```

## Debug en cas de problème

Si les middlewares ne fonctionnent pas :

1. **Vérifiez les logs :**
```bash
tail -f storage/logs/laravel.log
```

2. **Vérifiez la configuration :**
```bash
php artisan config:clear
php artisan cache:clear
```

3. **Vérifiez les middlewares enregistrés :**
```bash
php artisan route:list --middleware=admin
php artisan route:list --middleware=prof
php artisan route:list --middleware=eleve
``` 