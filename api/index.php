<?php

$main_dir = $_SERVER['DOCUMENT_ROOT'];

require_once $main_dir . '/engine/config.php';

global $API_TOKEN;


require_once $main_dir . '/classes/db.class.php';
require_once $main_dir . '/classes/task.class.php';
require_once $main_dir . '/classes/user.class.php';

// Проверяем наличие заголовка "Authorization" с токеном в запросе
// if (!isset($_REQUEST['HTTP_AUTHORIZATION'])) {
//     http_response_code(401);
//     echo json_encode(array("message" => "Доступ запрещен. Токен отсутствует."));
//     exit;
// }

// // Получаем токен из заголовка
// $token = $_REQUEST['HTTP_AUTHORIZATION'];

// // Проверяем токен на валидность
// if ($token != $API_TOKEN) {
//     http_response_code(401);
//     echo json_encode(array("message" => "Доступ запрещен. Недействительный токен."));
//     exit;
// }

// Создаем объект для работы с базой данных

global $pdo;
$db = new Database($pdo);

// Получаем данные из запроса
$data = $_POST['data'];

if (empty($data)) {
    http_response_code(400); // Неверный запрос
    die('Данные не были переданы');
}


if (isset($_SERVER['REQUEST_METHOD'])) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            switch ($_REQUEST['method']) {
                case "getUsers":
                    break;
            }
            break;
        case "POST":
            switch ($_REQUEST['method']) {
                case "postTask":
                    $db->addTask($data['name'], $data['description'], $data['place'], $data['type'], $data['misc'], $data['price'], $data['status'], $data['owner_id'], $data['date_ends']);
                    echo json_encode(['status' => 'success', 'message' => 'Данные успешно добавлены.']);
                    break;
            }
            break;
        case "PUT":
    
            break;
        case "DELETE":
    
            break;
        default:
            http_response_code(400);
            echo json_encode(array("message" => "Неверные данные."));
            break;
    }
}

?>