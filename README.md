# Gestion des Réservations d'Hôtel — PHP MVC (Web + Console)

Application PHP respectant l'architecture **MVC**, utilisant **PDO** pour l'accès à une base
de données relationnelle (MySQL), avec **deux points d'entrée** partageant les mêmes
Contrôleurs et Modèles :

- Une interface **Web** (`index.php`)
- Une interface **Console / CLI** (`console.php`)

## Arborescence

```
hotel-app/
├── database.sql                 # Script de création de la base et de la table
├── index.php                    # Routeur Web (point d'entrée HTTP)
├── console.php                  # Routeur CLI (point d'entrée terminal)
├── models/
│   ├── Database.php             # Connexion PDO (singleton)
│   └── ReservationModel.php     # Requêtes SQL (INSERT / SELECT / UPDATE)
├── controllers/
│   └── ReservationController.php  # Logique métier, orchestration
└── views/
    ├── web/                     # Formulaires et tableaux HTML
    │   ├── header.php / footer.php
    │   ├── home.php
    │   ├── form_create.php
    │   ├── list_active.php
    │   ├── form_cancel.php
    │   ├── revenue.php
    │   └── longest_stay.php
    └── console/                 # Affichage et saisies terminal (readline)
        ├── ConsoleView.php
        └── ConsoleInput.php
```

## Installation

1. **Créer la base de données** : importer `database.sql` dans PostgreSQL.
   ```bash
   psql -U postgres -f database.sql
   ```

2. **Configurer la connexion** : adapter les identifiants dans `models/Database.php`
   (`$host`, `$dbname`, `$user`, `$pass`).

3. **Vérifier le pilote PDO** : le projet utilise PostgreSQL via PDO (`pgsql`).
## Lancer l'interface Web

```bash
php -S localhost:8000
```
Puis ouvrir `http://localhost:8000` dans un navigateur.

## Lancer l'interface Console

```bash
php console.php
```
Un menu s'affiche en boucle dans le terminal ; les saisies se font via `readline()`.

## Fonctionnalités

| # | Fonctionnalité                              | Web                    | Console            |
|---|----------------------------------------------|------------------------|---------------------|
| 1 | Créer une réservation                        | Formulaire HTML        | Questions successives |
| 2 | Afficher les réservations actives (VALIDEE)  | Tableau `<table>`      | Liste texte formatée |
| 3 | Annuler une réservation (UPDATE, pas de DELETE) | Bouton "Annuler"    | Saisie de l'ID       |
| 4 | Calculer le chiffre d'affaires prévisionnel  | Montant en FCFA        | Montant en FCFA      |
| 5 | Afficher le séjour le plus long (gère ex-æquo) | Tableau               | Liste texte           |

## Grille tarifaire

| Type de chambre | Prix / nuit  |
|------------------|--------------|
| STANDARD         | 25 000 FCFA  |
| CONFORT          | 50 000 FCFA  |
| SUITE            | 100 000 FCFA |

## Respect de l'architecture MVC

- **Modèle** (`models/`) : exécute uniquement des requêtes SQL via PDO, aucune logique métier.
- **Contrôleur** (`controllers/`) : applique les règles de gestion (validations, vérifications),
  appelle le Modèle, prépare les données — **aucun `echo` direct**.
- **Vue** (`views/`) : uniquement de l'affichage (HTML pour le web, texte formaté avec `readline()`
  pour la console), aucune logique métier.
- Les deux points d'entrée (`index.php` et `console.php`) instancient **le même**
  `ReservationController`, garantissant que la logique métier n'est écrite qu'une seule fois.
