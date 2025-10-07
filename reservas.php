<?php
// Traz reservas + funcionário (se existir)
$query = "SELECT r.id, r.cliente, r.quarto, r.checkin, r.checkout, r.estado, e.employeeName
          FROM reservas r
          LEFT JOIN employees e ON r.employeeID = e.employeeID";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <h2 class="mb-4">Reservas</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Cliente</th>
                <th>Quarto</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Estado</th>
                <th>Funcionário</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["cliente"]."</td>";

                    // Campo Quarto — mostra "Atribuir Quarto" se estiver vazio
                    if (empty($row["quarto"])) {
                        echo "<td>
                                <a href='atribuirquarto.php?id=".$row["id"]."' 
                                   class='btn btn-warning btn-sm'>
                                   Atribuir Quarto
                                </a>
                              </td>";
                    } else {
                        echo "<td>".$row["quarto"]."</td>";
                    }

                    echo "<td>".$row["checkin"]."</td>";
                    echo "<td>".$row["checkout"]."</td>";

                    // Botões estado
                    if ($row["estado"] == "cancelado") {
                        echo "<td>
                                <a href='cancelar.php?id=".$row["id"]."&estado=ativo' class='btn btn-sm' style='background-color: #7CFC98; color: #fff;'>
                                    Ativar
                                </a>
                              </td>";
                    } else {
                        echo "<td>
                                <a href='cancelar.php?id=".$row["id"]."&estado=cancelado' class='btn btn-sm' style='background-color: #0d6efd; color: #fff;'>
                                    Cancelar
                                </a>
                              </td>";
                    }

                    // Funcionário (mostra "(API)" se não tiver)
                    echo "<td>".($row["employeeName"] ?? "(API)")."</td>";

                    // Link editar
                    echo "<td><a href='updateform.php?id=".$row["id"]."'><i class='bi bi-pencil' style='color: lime;'></i></a></td>";

                    // Link eliminar
                    echo "<td><a href='delete.php?id=".$row["id"]."' onclick='return confirm(\"Tens a certeza que queres eliminar esta reserva?\");'>
                            <i class='bi bi-trash text-danger'></i></a></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center text-danger'>Erro: " . mysqli_error($conn) . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


