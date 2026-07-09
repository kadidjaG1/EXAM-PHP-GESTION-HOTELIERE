<h2>Séjour le plus long</h2>

<?php if (empty($stays)): ?>
    <p class="empty">Aucune réservation active pour le moment.</p>
<?php else: ?>
    <p>
        <?= count($stays) > 1 ? "Plusieurs clients sont ex-æquo avec le plus grand nombre de nuits :" : "Voici le client avec le plus grand nombre de nuits :" ?>
    </p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Chambre</th>
                <th>Nuits</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($stays as $r): ?>
            <tr>
                <td><?= (int) $r['id'] ?></td>
                <td><?= htmlspecialchars($r['nom_client']) ?></td>
                <td><?= (int) $r['numero_chambre'] ?></td>
                <td><?= (int) $r['nombre_nuits'] ?></td>
                <td><?= htmlspecialchars($r['type_chambre']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
