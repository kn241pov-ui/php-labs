<?php

class RegformController extends PageController
{
    public function action_form(): void
    {
        $errors = [];
        $old = [];

        if ($this->request->isPost()) {
            $old = $this->request->allPost();
            $errors = $this->validate($old);

            if (empty($errors)) {
                $_SESSION['reg_success'] = true;
                $_SESSION['reg_data'] = [
                    'login' => is_string($old['login'] ?? '') ? trim($old['login']) : '',
                ];
                $this->redirect('regform/done');
                return;
            }
        }

        $this->render('regform/form', [
            'errors' => $errors,
            'old' => $old,
        ], 'Реєстрація');
    }

    public function action_done(): void
    {
        if (empty($_SESSION['reg_success'])) {
            $this->redirect('regform/form');
            return;
        }

        $data = $_SESSION['reg_data'] ?? [];
        unset($_SESSION['reg_success'], $_SESSION['reg_data']);

        $this->render('regform/done', ['regData' => $data], 'Реєстрація успішна');
    }

    private function validate(array $data): array {
    $errors = [];
    $login = trim($data['login'] ?? '');
    $p1 = $data['password'] ?? '';
    $p2 = $data['password_confirm'] ?? '';
    $email = trim($data['email'] ?? '');

    // Логін (просто обов'язковий)
    if ($login === '') $errors['login'] = "Логін є обов'язковим.";

    // Пароль 1 та Пароль 2 мають збігатися
    if ($p1 !== $p2) $errors['password_confirm'] = "Паролі не збігаються.";

    // Пароль — мінімум 5 символів
    if (strlen($p1) < 5) $errors['password'] = "Пароль занадто короткий, мінімум 5 символів.";

    // Пароль — має містити щонайменше 1 цифру
    if (!preg_match('/\d/', $p1)) $errors['password_digit'] = "Пароль має містити хоча б одну цифру.";

    // E-mail — формат: символи@хост.зона
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Невірний формат електронної пошти.";
    }

    return $errors;
}
}
