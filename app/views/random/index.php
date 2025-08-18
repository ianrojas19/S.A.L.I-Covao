<?php


$cedulaProfesor = 305550333; // o la recibís por otra vía

$sql = "
SELECT 
    e.nombre AS especialidad,
    h.dia,
    h.bloque,
    s.nombre AS subarea,
    a.nombre AS aula,
    g.nombre AS grupo
FROM horarios h
JOIN profesores p ON h.profesor_id = p.id
JOIN especialidades e ON h.especialidad_id = e.id
JOIN subareas s ON h.subarea_id = s.id
JOIN aulas a ON h.aula_id = a.id
JOIN grupos g ON h.grupo_id = g.id
WHERE p.cedula = ?
ORDER BY e.nombre, FIELD(h.dia, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'), h.bloque
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $cedulaProfesor);
$stmt->execute();
$result = $stmt->get_result();

$horarios = [];

while ($row = $result->fetch_assoc()) {
    $esp = $row['especialidad'];
    $dia = $row['dia'];
    $bloque = (int)$row['bloque'] - 1; // para indexar de 0 a 16

    if (!isset($horarios[$esp])) {
        $horarios[$esp] = [
            'especialidad' => $esp,
            'dias' => [
                'Lunes' => array_fill(0, 17, null),
                'Martes' => array_fill(0, 17, null),
                'Miércoles' => array_fill(0, 17, null),
                'Jueves' => array_fill(0, 17, null),
                'Viernes' => array_fill(0, 17, null),
            ]
        ];
    }

    $horarios[$esp]['dias'][$dia][$bloque] = [
        'subarea' => $row['subarea'],
        'aula' => $row['aula'],
        'grupo' => $row['grupo']
    ];
}

// Asegurar que todos los bloques estén completos (rellenar los nulls vacíos con estructura)
foreach ($horarios as &$esp) {
    foreach ($esp['dias'] as &$diaBloques) {
        foreach ($diaBloques as $i => $bloque) {
            if ($bloque === null) {
                $diaBloques[$i] = [
                    'subarea' => null,
                    'aula' => null,
                    'grupo' => null
                ];
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode(array_values($horarios), JSON_PRETTY_PRINT);
