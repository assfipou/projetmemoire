# Guide d'utilisation des Middlewares d'authentification et d'autorisation

## Vue d'ensemble

Ce système de middlewares permet de contrôler l'accès aux pages selon le rôle de l'utilisateur connecté. Il empêche par exemple qu'un élève accède à la page professeur ou qu'un professeur accède à la page admin.

## Middlewares disponibles

### 1. `admin`
- **Fichier**: `app/Http/Middleware/RedirectIfAdmin.php`
- **Fonction**: Vérifie que l'utilisateur a le rôle 'admin'
- **Redirection**: 
  - Si élève → pageeleve
  - Si professeur → pageprof
  - Si non connecté → login

### 2. `prof`
- **Fichier**: `app/Http/Middleware/RedirectIfProf.php`
- **Fonction**: Vérifie que l'utilisateur a le rôle 'professeur'
- **Redirection**:
  - Si admin → pageadmin
  - Si élève → pageeleve
  - Si non connecté → login

### 3. `eleve`
- **Fichier**: `app/Http/Middleware/RedirectIfEleve.php`
- **Fonction**: Vérifie que l'utilisateur a le rôle 'eleve'
- **Redirection**:
  - Si admin → pageadmin
  - Si professeur → pageprof
  - Si non connecté → login

### 4. `role.redirect`
- **Fichier**: `app/Http/Middleware/RedirectBasedOnRole.php`
- **Fonction**: Redirige automatiquement les utilisateurs connectés vers leur page appropriée
- **Utilisation**: Appliqué aux routes publiques

## Utilisation dans les routes

```php
// Routes protégées par authentification et rôle
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/pageadmin', [AdminController::class, 'afficherAdmin'])->name('pageadmin');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

Route::middleware(['auth', 'prof'])->group(function () {
    Route::get('/pageprof', [ProfController::class, 'afficherProf'])->name('pageprof');
});

Route::middleware(['auth', 'eleve'])->group(function () {
    Route::get('/pageeleve', [EleveController::class, 'afficherEleve'])->name('pageeleve');
});

// Routes publiques avec redirection automatique
Route::middleware(['role.redirect'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('accueil');
});
```

## Messages d'erreur

Le système affiche automatiquement des messages d'erreur appropriés :

- "Vous devez être connecté pour accéder à cette page."
- "Accès réservé aux administrateurs."
- "Accès réservé aux professeurs."
- "Accès réservé aux élèves."

## Redirection après connexion

Après une connexion réussie, l'utilisateur est automatiquement redirigé vers sa page appropriée selon son rôle :

- **Admin** → `/pageadmin`
- **Professeur** → `/pageprof`
- **Élève** → `/pageeleve`

## Ajout d'un nouveau middleware

Pour ajouter un nouveau middleware :

1. Créer le fichier dans `app/Http/Middleware/`
2. L'enregistrer dans `app/Http/Kernel.php`
3. L'utiliser dans les routes

Exemple :
```php
// Dans Kernel.php
'nouveau_role' => \App\Http\Middleware\RedirectIfNouveauRole::class,

// Dans les routes
Route::middleware(['auth', 'nouveau_role'])->group(function () {
    // Routes protégées
});
```

## Tests

Pour tester le système :

1. Connectez-vous avec un compte élève
2. Essayez d'accéder à `/pageprof` ou `/pageadmin`
3. Vous devriez être redirigé vers `/pageeleve` avec un message d'erreur

## Sécurité

- Tous les middlewares vérifient l'authentification
- Les redirections sont sécurisées
- Les messages d'erreur sont informatifs mais ne révèlent pas d'informations sensibles 