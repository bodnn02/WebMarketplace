<?php 

$main_dir = $_SERVER['DOCUMENT_ROOT'];

require_once $main_dir. '/engine/db.php';

class Database {
    private $connection;

    public function __construct($pdo) {
        $this->connection = $pdo;
    }

    public function executeQuery($query, $params = []) {
        try {
            // Подготовка и выполнение запроса
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);

            // Получение результата запроса
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Закрытие подготовленного запроса
            $stmt->closeCursor();

            return $data;
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        // Закрытие соединения с базой данных
        $this->connection = null;
    }

    // User запросы:

    // Метод добавления пользователя
    public function addUser($name, $phone, $login, $password) {
        $query = "INSERT INTO users (name, phone, login, password) VALUES (:name, :phone, :login, :password)";
        $params = [
            ':name' => $name,
            ':phone' => $phone,
            ':login' => $login,
            ':password' => $password
        ];

        try {
            $stmt =$this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка Добавления
        }
    }

    // Метод для обновления имени пользователя
    public function updateUserName($newName, $userId) {
        $query = "UPDATE users SET name = :newName WHERE id = :userId";
        $params = [
            ':newName' => $newName,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления телефона пользователя
    public function updateUserPhone($newPhone, $userId) {
        $query = "UPDATE users SET phone = :newPhone WHERE id = :userId";
        $params = [
            ':newPhone' => $newPhone,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления логина пользователя
    public function updateUserLogin($newLogin, $userId) {
        $query = "UPDATE users SET login = :newLogin WHERE id = :userId";
        $params = [
            ':newLogin' => $newLogin,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления роли пользователя
    public function updateUserRole($newRole, $userId) {
        $query = "UPDATE users SET role = :newRole WHERE id = :userId";
        $params = [
            ':newRole' => $newRole,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления баланса пользователя
    public function updateUserBalance($newBalance, $userId) {
        $query = "UPDATE users SET balance = :newBalance WHERE id = :userId";
        $params = [
            ':newBalance' => $newBalance,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления методов оплаты пользователя
    public function updateUserPaymentMethods($newPaymentMethods, $userId) {
        $query = "UPDATE users SET payment_methods = :newPaymentMethods WHERE id = :userId";
        $params = [
            ':newPaymentMethods' => $newPaymentMethods,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления рейтинга пользователя
    public function updateUserRating($newRating, $userId) {
        $query = "UPDATE users SET rating = :newRating WHERE id = :userId";
        $params = [
            ':newRating' => $newRating,
            ':userId' => $userId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для получения имени пользователя из БД
    public function fetchName($userId) {
        $query = "SELECT name FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return $result[0]['name'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения телефона пользователя из БД
    public function fetchPhone($userId) {
        $query = "SELECT phone FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return $result[0]['phone'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения логина пользователя из БД
    public function fetchLogin($userId) {
        $query = "SELECT login FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return $result[0]['login'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения роли пользователя из БД
    public function fetchRole($userId) {
        $query = "SELECT role FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return $result[0]['role'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения баланса пользователя из БД
    public function fetchBalance($userId) {
        $query = "SELECT balance FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return (float)$result[0]['balance'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения методов оплаты пользователя из БД
    public function fetchPaymentMethods($userId) {
        $query = "SELECT payment_methods FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return $result[0]['payment_methods'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения рейтинга пользователя из БД
    public function fetchRating($userId) {
        $query = "SELECT rating FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        try {
            $result = $this->executeQuery($query, $params);
            if (count($result) > 0) {
                return (int)$result[0]['rating'];
            } else {
                return null; // Если пользователь не найден
            }
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }
    
    
    // Task запросы:

    // Метод для добавления задачи
    public function addTask($name, $description, $place, $type, $misc, $price, $status, $owner_id, $date_ends) {
        $query = "INSERT INTO tasks (name, description, place, type, misc, price, status, owner_id, date_ends) VALUES (:name, :description, :place, :type, :misc, :price, :status, :owner_id, :date_ends)";
        $params = [
            ':name' => $name,
            ':description' => $description,
            ':place' => $place,
            ':type' => $type,
            ':misc' => $misc,
            ':price' => $price,
            ':status' => $status,
            ':owner_id' => $owner_id,
            ':date_ends' => $date_ends
        ];

        try {
            $stmt =$this->executeQuery($query, $params);
            if (is_array($stmt)) {
                return true; // Успешное добавление
            } else {
                return false; // Ошибка добавления
            }
        } catch (PDOException $e) {
            return false; // Ошибка Добавления
        }
    }

    public function updateTaskName($newName, $taskId) {
        $query = "UPDATE task SET name = :newName WHERE id = :taskId";
        $params = [
            ':newName' => $newName,
            ':taskId' => $taskId
        ];
    
        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }
    
    // Метод для обновления места задачи
    public function updateTaskPlace($newPlace, $taskId) {
        $query = "UPDATE task SET place = :newPlace WHERE id = :taskId";
        $params = [
            ':newPlace' => $newPlace,
            ':taskId' => $taskId
        ];
    
        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления типа задачи
    public function updateTaskType($newType, $taskId) {
        $query = "UPDATE task SET type = :newType WHERE id = :taskId";
        $params = [
            ':newType' => $newType,
            ':taskId' => $taskId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления дополнительной информации о задаче (misc)
    public function updateTaskMisc($newMisc, $taskId) {
        $query = "UPDATE task SET misc = :newMisc WHERE id = :taskId";
        $params = [
            ':newMisc' => $newMisc,
            ':taskId' => $taskId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления цены задачи
    public function updateTaskPrice($newPrice, $taskId) {
        $query = "UPDATE task SET price = :newPrice WHERE id = :taskId";
        $params = [
            ':newPrice' => $newPrice,
            ':taskId' => $taskId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления статуса задачи
    public function updateTaskStatus($newStatus, $taskId) {
        $query = "UPDATE task SET status = :newStatus WHERE id = :taskId";
        $params = [
            ':newStatus' => $newStatus,
            ':taskId' => $taskId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Метод для обновления owner_id задачи
    public function updateTaskOwnerId($newOwnerId, $taskId) {
        $query = "UPDATE task SET owner_id = :newOwnerId WHERE id = :taskId";
        $params = [
            ':newOwnerId' => $newOwnerId,
            ':taskId' => $taskId
        ];

        try {
            $stmt = $this->executeQuery($query, $params);
            return $stmt->rowCount() > 0; // Проверка на успешное обновление
        } catch (PDOException $e) {
            return false; // Ошибка обновления
        }
    }

    // Task fetch запросы:

    // Метод для получения типа задачи из БД
    public function fetchTaskType($taskId) {
        $query = "SELECT type FROM task WHERE id = :taskId";
        $params = [':taskId' => $taskId];

        try {
            $result = $this->executeQuery($query, $params);
            $type = $result[0]['type'];
            return $type;
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения дополнительной информации о задаче (misc) из БД
    public function fetchTaskMisc($taskId) {
        $query = "SELECT misc FROM task WHERE id = :taskId";
        $params = [':taskId' => $taskId];

        try {
            $result = $this->executeQuery($query, $params);
            $misc = $result[0]['misc'];
            return $misc;
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения цены задачи из БД
    public function fetchTaskPrice($taskId) {
        $query = "SELECT price FROM task WHERE id = :taskId";
        $params = [':taskId' => $taskId];

        try {
            $result = $this->executeQuery($query, $params);
            $price = (float)$result[0]['price'];
            return $price;
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения статуса задачи из БД
    public function fetchTaskStatus($taskId) {
        $query = "SELECT status FROM task WHERE id = :taskId";
        $params = [':taskId' => $taskId];

        try {
            $result = $this->executeQuery($query, $params);
            $status = $result[0]['status'];
            return $status;
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }

    // Метод для получения owner_id задачи из БД
    public function fetchTaskOwnerId($taskId) {
        $query = "SELECT owner_id FROM task WHERE id = :taskId";
        $params = [':taskId' => $taskId];

        try {
            $result = $this->executeQuery($query, $params);
            $owner_id = (int)$result[0]['owner_id'];
            return $owner_id;
        } catch (PDOException $e) {
            return false; // Обработка ошибки
        }
    }
}

?>