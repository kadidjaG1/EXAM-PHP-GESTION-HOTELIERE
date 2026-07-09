<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Réservations - Hôtel</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 0; color: #2b2f38; }
        header { background: #1f2a44; color: #fff; padding: 20px 30px; }
        header h1 { margin: 0; font-size: 22px; }
        nav { background: #2c3a5e; padding: 10px 30px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-size: 14px; }
        nav a:hover { text-decoration: underline; }
        .container { max-width: 900px; margin: 30px auto; background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #1f2a44; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #e2e5ea; text-align: left; font-size: 14px; }
        th { background: #f0f2f5; }
        form label { display: block; margin-top: 12px; font-size: 14px; font-weight: bold; }
        form input, form select { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 18px; background: #1f2a44; color: #fff; border: none; padding: 10px 18px; border-radius: 4px; cursor: pointer; font-size: 14px; }
        button:hover { background: #2c3a5e; }
        .btn-cancel { background: #b23b3b; padding: 5px 10px; font-size: 12px; }
        .btn-cancel:hover { background: #8f2e2e; }
        .message { padding: 12px 15px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; }
        .message.success { background: #e2f5e6; color: #1e6b31; border: 1px solid #b9e3c2; }
        .message.error { background: #fbe6e6; color: #8a1f1f; border: 1px solid #f2b8b8; }
        .revenue { font-size: 28px; font-weight: bold; color: #1f2a44; }
        .empty { color: #777; font-style: italic; }
    </style>
</head>
<body>
<header>
    <h1>🏨 Gestion des Réservations d'Hôtel</h1>
</header>
<nav>
    <a href="index.php">Accueil</a>
    <a href="index.php?action=create">Nouvelle réservation</a>
    <a href="index.php?action=list">Réservations actives</a>
    <a href="index.php?action=cancel">Annuler une réservation</a>
    <a href="index.php?action=revenue">Chiffre d'affaires</a>
    <a href="index.php?action=longest">Séjour le plus long</a>
</nav>
<div class="container">
