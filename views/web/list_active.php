<h2>Réservations actives</h2>

<?php if (empty($reservations)): ?>
    <p class="empty">Aucune réservation active pour le moment.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Chambre</th>
                <th>Nuits</th>
                <th>Type</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservations as $r): ?>
            <tr>
                <td><?= (int) $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nom_client']) ?></td>
                <td><?= (int) $r['numero_chambre'] ?></td>
                <td><?= (int) $r['nombre_nuits'] ?></td>
                <td><?= htmlspecialchars($r['type_chambre']) ?></td>
                <td><?= htmlspecialchars($r['statut']) ?></td>
                <td>
                    <form method="POST" action="index.php?action=cancel" style="display:inline;">
                        <input type="hidden" name="id" value="<?= (int) $r['id'] ?>">
                        <button type="submit" class="btn-cancel" onclick="return confirm('Annuler cette réservation ?');">Annuler</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
