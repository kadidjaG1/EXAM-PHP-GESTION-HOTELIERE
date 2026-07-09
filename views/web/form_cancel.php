<h2>Annuler une réservation</h2>

<?php if (isset($result)): ?>
    <div class="message <?= $result['success'] ? 'success' : 'error' ?>">
        <?= htmlspecialchars($result['message']) ?>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?action=cancel">
    <label for="id">Numéro (ID) de la réservation à annuler</label>
    <input type="number" id="id" name="id" min="1" required>

    <button type="submit">Annuler la réservation</button>
</form>
