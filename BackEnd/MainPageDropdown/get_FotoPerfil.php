<?php
    $query = "SELECT foto_perfil FROM users WHERE nome = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($profileImage);

    if ($stmt->fetch() && !empty($profileImage)) {
    $userImg = 'data:image/png;base64,' . base64_encode($profileImage);
    }

    $stmt->close();
?>