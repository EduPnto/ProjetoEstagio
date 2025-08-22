<?php
    header('Content-Type: application/json');

    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/erros_updateBeneficiario.log');

    include $_SERVER['DOCUMENT_ROOT'] . '/ProjetoEstagio/BackEnd/DataBase/db_connect.php';

    function jsonResponse($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $inputData = json_decode(file_get_contents("php://input"), true);

    if (!is_array($inputData)) {
        jsonResponse(['success' => false, 'message' => 'Formato de dados inválido.'], 400);
    }

    if ($conn->connect_error) {
        jsonResponse(['success' => false, 'message' => 'Falha na conexão com o banco de dados.'], 500);
    }

    $nissURL = $inputData['niss_url'] ?? null;
    if (!$nissURL) {
        jsonResponse(['success' => false, 'message' => 'NISS da URL não informado.'], 400);
    }

    $stmtId = $conn->prepare("SELECT Id_Bene FROM beneficiarios WHERE NISS = ?");
    $stmtId->bind_param("i", $nissURL);
    $stmtId->execute();
    $resId = $stmtId->get_result();
    $rowId = $resId->fetch_assoc();
    $stmtId->close();

    if (!$rowId) {
        jsonResponse(['success' => false, 'message' => 'Beneficiário não encontrado pelo NISS da URL.'], 404);
    }

    $Id_Bene = (int)$rowId['Id_Bene'];

    $stmtSelect = $conn->prepare("SELECT * FROM beneficiarios WHERE Id_Bene = ?");
    $stmtSelect->bind_param("i", $Id_Bene);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $dadosAtuais = $result->fetch_assoc();
    $stmtSelect->close();

    if (!$dadosAtuais) {
        jsonResponse(['success' => false, 'message' => 'Beneficiário não encontrado.'], 404);
    }

    $novoNiss = $inputData['niss_formulario'] ?? $dadosAtuais['NISS'];
    $inputData['NISS'] = $novoNiss;

    $camposPossiveis = [
        'nome_Bene', 'Genero', 'NIF', 'NISS', 'BI', 'Morada', 'Contacto', 'Cod_Postal',
        'Data_nasc', 'Data_Admissao', 'Data_Saida', 'Id_Enti', 'Id_Apoio', 'Id_Alimentar',
        'Incap_Defec', 'Auto_Depen', 'Sit_sem_abrigo', 'Sit_Emprego', 'Imigrante',
        'Id_Sigla', 'rendi_Capita', 'SAAS', 'Id_Titular', 'Observacao'
    ];

    $camposData = ['Data_nasc', 'Data_Admissao', 'Data_Saida'];

    $camposNumericos = [
        'NIF', 'NISS', 'Id_Enti', 'Id_Apoio', 'Id_Alimentar',
        'Id_Sigla', 'Id_Titular'
    ];

    $sets = [];
    $valores = [];
    $tipos = [];

    foreach ($camposPossiveis as $campo) {
        if (!array_key_exists($campo, $inputData)) continue;

        $novoValor = $inputData[$campo];
        $valorAtual = $dadosAtuais[$campo] ?? null;

        if (is_string($novoValor)) $novoValor = trim($novoValor);
        if (is_string($valorAtual)) $valorAtual = trim($valorAtual);

        if (in_array($campo, $camposData) && !empty($novoValor)) {
            $novoValor = date('Y-m-d', strtotime($novoValor));
        }
        if (in_array($campo, $camposData) && !empty($valorAtual)) {
            $valorAtual = date('Y-m-d', strtotime($valorAtual));
        }

        if ($novoValor === '') $novoValor = null;

        if ($novoValor !== $valorAtual) {
            $sets[] = "$campo = ?";
            $valores[] = $novoValor;

            if (in_array($campo, $camposNumericos) && $novoValor !== null && is_numeric($novoValor)) {
                $tipos[] = 'i';
            } else {
                $tipos[] = 's';
            }
        }
    }

    if (empty($sets)) {
        jsonResponse(['success' => false, 'message' => 'Nenhuma alteração detectada.']);
    }

    if (isset($inputData['SAAS']) && $inputData['SAAS'] == 1) {
        $nomeTitular = $inputData['nome'];

        $stmtInsertSaas = $conn->prepare("INSERT INTO acompanhamento_saas (Id_Titular, Id_Bene, nome) VALUES (?, ?, ?)");
        if ($stmtInsertSaas) {
            $result6 = $conn->query("SELECT MAX(Id_Titular) FROM acompanhamento_saas");
            $row6 = $result6->fetch_assoc();
            $Id_Titular = $row6['Id_Titular'] + 1;

            $stmtInsertSaas->bind_param("iis", $Id_Titular, $Id_Bene, $nomeTitular);
            if (!$stmtInsertSaas->execute()) {
                error_log("Erro ao inserir em acompanhamento_saas: " . $stmtInsertSaas->error);
            }
            $stmtInsertSaas->close();
        } else {
            error_log("Erro ao preparar INSERT acompanhamento_saas: " . $conn->error);
        }
    }

    $sql = "UPDATE beneficiarios SET " . implode(", ", $sets) . " WHERE Id_Bene = ?";
    $valores[] = $Id_Bene;
    $tipos[] = 'i';

    $stmtUpdate = $conn->prepare($sql);
    if (!$stmtUpdate) {
        jsonResponse(['success' => false, 'message' => 'Erro na preparação do UPDATE.']);
    }

    $stmtUpdate->bind_param(implode('', $tipos), ...$valores);

    $debugSQL = $sql;
    foreach ($valores as $v) {
        $vStr = ($v === null) ? "NULL" : "'" . $conn->real_escape_string($v) . "'";
        $debugSQL = preg_replace("/\?/", $vStr, $debugSQL, 1);
    }
    error_log("SQL Final: $debugSQL");
    error_log("Tipos: " . implode('', $tipos));
    error_log("Valores: " . print_r($valores, true));

    if ($stmtUpdate->execute()) {
        jsonResponse(['success' => true, 'message' => 'Dados atualizados com sucesso.']);
    } else {
        jsonResponse(['success' => false, 'message' => 'Erro ao atualizar beneficiário.', 'error' => $stmtUpdate->error]);
    }

    $stmtUpdate->close();
    $conn->close();
?>