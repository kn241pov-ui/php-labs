<?php

class OrderController extends PageController
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    public function action_list(): void
{
    // Отримуємо поле, за яким сортуємо (за замовчуванням 'id')
    $sort = $this->request->get('sort', 'id');
    // Напрямок (за замовчуванням 'DESC')
    $order = $this->request->get('order', 'DESC');

    // Безпечний список полів, щоб ніхто не підсунув свій SQL
    $allowed = ['id', 'client_name', 'weight_kg', 'price', 'status'];
    if (!in_array($sort, $allowed)) { $sort = 'id'; }

    $sql = "SELECT * FROM orders ORDER BY $sort $order";
    $stmt = $this->db->query($sql);
    $orders = $stmt->fetchAll();

    $this->render('order/list', ['orders' => $orders], 'Список замовлень');
}

    public function action_create(): void
    {
        $errors = [];
        $old = [];

        if ($this->request->isPost()) {
            $old = $this->request->allPost();
            $errors = $this->validate($old);

            if (empty($errors)) {
                try {
                    $stmt = $this->db->prepare(
                        'INSERT INTO orders (client_name, service_type, weight_kg, price, status)
                         VALUES (:client_name, :service_type, :weight_kg, :price, :status)'
                    );
                    $stmt->execute([
                        ':client_name' => trim($old['client_name']),
                        ':service_type' => trim($old['service_type']),
                        ':weight_kg' => (float)$old['weight_kg'],
                        ':price' => (float)$old['price'],
                        ':status' => $old['status'] ?? 'прийнято'
                    ]);

                    $_SESSION['flash_success'] = 'Замовлення створено!';
                    $this->redirect('order/list');
                    return;
                } catch (PDOException $e) {
                    $errors['db'] = 'Помилка БД: ' . $e->getMessage();
                }
            }
        }

        $this->render('order/create', ['errors' => $errors, 'old' => $old], 'Нове замовлення');
    }

    public function action_edit(): void
    {
        $id = (int)$this->request->post('id', $this->request->get('id', 0));
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $order = $stmt->fetch();

        if (!$order) { $this->redirect('order/list'); return; }

        $errors = [];
        if ($this->request->isPost()) {
            $data = $this->request->allPost();
            $errors = $this->validate($data);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'UPDATE orders SET client_name = :client_name, service_type = :service_type, 
                     weight_kg = :weight_kg, price = :price, status = :status WHERE id = :id'
                );
                $stmt->execute([
                    ':client_name' => trim($data['client_name']),
                    ':service_type' => trim($data['service_type']),
                    ':weight_kg' => (float)$data['weight_kg'],
                    ':price' => (float)$data['price'],
                    ':status' => $data['status'],
                    ':id' => $id
                ]);
                $this->redirect('order/list');
                return;
            }
            $order = array_merge($order, $data);
        }

        $this->render('order/edit', ['order' => $order, 'errors' => $errors], 'Редагувати замовлення');
    }

    public function action_delete(): void
    {
        if ($this->request->isPost()) {
            $id = (int)$this->request->post('id', 0);
            $stmt = $this->db->prepare('DELETE FROM orders WHERE id = :id');
            $stmt->execute([':id' => $id]);
        }
        $this->redirect('order/list');
    }

    private function validate(array $data): array
    {
        $errors = [];
        if (empty(trim($data['client_name']))) $errors['client_name'] = "ПІБ клієнта обов'язкове.";
        if (empty($data['weight_kg']) || $data['weight_kg'] <= 0) $errors['weight_kg'] = "Вага має бути > 0.";
        if (empty($data['price']) || $data['price'] <= 0) $errors['price'] = "Ціна має бути > 0.";
        return $errors;
    }
}