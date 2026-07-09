<h2>Nouvelle réservation</h2>

<?php if (isset($result)): ?>
    <div class="message <?= $result['success'] ? 'success' : 'error' ?>">
        <?= htmlspecialchars($result['message']) ?>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?action=create">
    <label for="nom_client">Nom du client</label>
    <input type="text" id="nom_client" name="nom_client" required>

    <label for="numero_chambre">Numéro de chambre</label>
    <input type="number" id="numero_chambre" name="numero_chambre" min="1" required>

    <label for="nombre_nuits">Nombre de nuits</label>
    <input type="number" id="nombre_nuits" name="nombre_nuits" min="1" required>

    <label for="type_chambre">Type de chambre</label>
    <select id="type_chambre" name="type_chambre" required>
        <option value="STANDARD">STANDARD (25 000 FCFA / nuit)</option>
        <option value="CONFORT">CONFORT (50 000 FCFA / nuit)</option>
        <option value="SUITE">SUITE (100 000 FCFA / nuit)</option>
    </select>

    <button type="submit">Enregistrer la réservation</button>
</form>
