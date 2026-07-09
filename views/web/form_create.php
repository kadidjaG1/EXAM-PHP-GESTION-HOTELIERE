<h2>Nouvelle réservation</h2>

<?php if (isset($result)): ?>
    <div class="message <?= $result['success'] ? 'success' : 'error' ?>">
        <?= htmlspecialchars($result['message']) ?>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?action=create">
    <label for="nom_client">Nom du client</label>
    <input type="text" id="nom_client" name="nom_client" value="<?= htmlspecialchars($_POST['nom_client'] ?? '') ?>" required>

    <label for="numero_chambre">Numéro de chambre</label>
    <select id="numero_chambre" name="numero_chambre" <?= empty($availableRooms) ? 'disabled' : 'required' ?>>
        <option value="">Sélectionnez une chambre disponible</option>
        <?php if (!empty($availableRooms)): ?>
            <?php foreach ($availableRooms as $room): ?>
                <option value="<?= (int) $room ?>" <?= isset($_POST['numero_chambre']) && (int) $_POST['numero_chambre'] === (int) $room ? 'selected' : '' ?>>Chambre <?= (int) $room ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="" disabled>Aucune chambre disponible</option>
        <?php endif; ?>
    </select>

    <label for="nombre_nuits">Nombre de nuits</label>
    <input type="number" id="nombre_nuits" name="nombre_nuits" min="1" value="<?= isset($_POST['nombre_nuits']) ? (int) $_POST['nombre_nuits'] : '' ?>" required>

    <label for="type_chambre">Type de chambre</label>
    <select id="type_chambre" name="type_chambre" required>
        <option value="STANDARD" <?= (isset($_POST['type_chambre']) && $_POST['type_chambre'] === 'STANDARD') ? 'selected' : '' ?>>STANDARD (25 000 FCFA / nuit)</option>
        <option value="CONFORT" <?= (isset($_POST['type_chambre']) && $_POST['type_chambre'] === 'CONFORT') ? 'selected' : '' ?>>CONFORT (50 000 FCFA / nuit)</option>
        <option value="SUITE" <?= (isset($_POST['type_chambre']) && $_POST['type_chambre'] === 'SUITE') ? 'selected' : '' ?>>SUITE (100 000 FCFA / nuit)</option>
    </select>

    <button type="submit" <?= empty($availableRooms) ? 'disabled' : '' ?>>Enregistrer la réservation</button>
</form>
