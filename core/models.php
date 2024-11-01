<?php  

function insertCrocheter($pdo, $username, $password, $first_name, $last_name, 
    $date_of_birth, $phone_number, $email_address, $expertise) {

    $checkSql = "SELECT COUNT(*) FROM crocheters WHERE username = ? OR email_address = ?";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([$username, $email_address]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        return ['error' => 'Username or email already exists'];
    }

    $sql = "INSERT INTO crocheters (username, password, first_name, last_name, 
        date_of_birth, phone_number, email_address, expertise) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$username, $password, $first_name, $last_name, 
        $date_of_birth, $phone_number, $email_address, $expertise]);

    if ($executeQuery) {
        return true;
    } else {
        return ['error' => 'Database insertion error'];
    }
}

function loginUser($pdo, $username, $password) {
    $sql = "SELECT crocheter_id, username, password, first_name, last_name FROM crocheters WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        return [
            'crocheter_id' => $user['crocheter_id'],
            'username' => $user['username'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name']
        ];
    }
    return false; 
}

function updateCrocheter($pdo, $username, $firstName, $lastName, $dateOfBirth, $phoneNumber, $emailAddress, $expertise, $password, $crocheterId) {
    $sql = "UPDATE crocheters SET username = ?, first_name = ?, last_name = ?, date_of_birth = ?, phone_number = ?, email_address = ?, expertise = ?";
    $params = [$username, $firstName, $lastName, $dateOfBirth, $phoneNumber, $emailAddress, $expertise];

    if (!empty($password)) {
        $sql .= ", password = ?";
        $params[] = password_hash($password, PASSWORD_BCRYPT);
    }

    $sql .= " WHERE crocheter_id = ?";
    $params[] = $crocheterId;

    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}


function deleteCrocheter($pdo, $crocheterId) {
    $sql = "DELETE FROM crocheters WHERE crocheter_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$crocheterId]);
}

function insertProject($pdo, $projectName, $typeOfCrochet, $crocheterId) {
    $sql = "INSERT INTO projects (project_name, type_of_crochet, crocheter_id, created_by) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$projectName, $typeOfCrochet, $crocheterId, $crocheterId]);
}

function updateProject($pdo, $projectName, $typeOfCrochet, $projectId, $crocheterId) {
    $sql = "UPDATE projects SET project_name = ?, type_of_crochet = ?, last_updated_at = CURRENT_TIMESTAMP WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    
    return $stmt->execute([$projectName, $typeOfCrochet, $projectId]);
}

function deleteProject($pdo, $projectId) {
    $sql = "DELETE FROM projects WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$projectId]);
}

function getAllCrocheters($pdo) {
    $sql = "SELECT * FROM crocheters";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getCrocheterByID($pdo, $crocheter_id) {
    $sql = "SELECT * FROM crocheters WHERE crocheter_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$crocheter_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function getProjectsByCrocheter($pdo, $crocheter_id) {
    $sql = "SELECT 
                projects.project_id AS project_id,
                projects.project_name AS project_name,
                projects.type_of_crochet AS type_of_crochet,
                projects.date_added AS date_added,
                CONCAT(crocheters.first_name, ' ', crocheters.last_name) AS project_owner
            FROM projects
            JOIN crocheters ON projects.crocheter_id = crocheters.crocheter_id
            WHERE projects.crocheter_id = ? 
            GROUP BY projects.project_name;";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$crocheter_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getAllProjects($pdo) {
    $sql = "SELECT 
                projects.project_id AS project_id,
                projects.project_name AS project_name,
                projects.type_of_crochet AS type_of_crochet,
                projects.date_added AS date_added,
                CONCAT(creator.first_name, ' ', creator.last_name) AS created_by,
                projects.last_updated_at AS last_updated_at  
            FROM projects
            JOIN crocheters AS creator ON projects.created_by = creator.crocheter_id
            ORDER BY projects.project_id";  

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getProjectByID($pdo, $project_id) {
    $sql = "SELECT 
                projects.project_id AS project_id,
                projects.project_name AS project_name,
                projects.type_of_crochet AS type_of_crochet,
                projects.date_added AS date_added,
                CONCAT(crocheters.first_name, ' ', crocheters.last_name) AS project_owner
            FROM projects
            JOIN crocheters ON projects.crocheter_id = crocheters.crocheter_id
            WHERE projects.project_id = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$project_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
}

?>