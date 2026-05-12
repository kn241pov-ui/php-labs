<?php

class SettingsController extends PageController
{
    private array $availableColors = [
        '#f9fafb' => 'Стандартний (світло-сірий)',
        '#dbeafe' => 'Блакитний',
        '#dcfce7' => 'Зелений',
        '#fef9c3' => 'Жовтий',
        '#fce7f3' => 'Рожевий',
        '#f3e8ff' => 'Фіолетовий',
        '#ffedd5' => 'Помаранчевий',
        '#ffffff' => 'Білий',
    ];

    public function action_color() {
    $colors = [
        '#f9fafb' => 'Світлий',
        '#e5e7eb' => 'Сірий',
        '#fef2f2' => 'Рожевий',
        '#f0fdf4' => 'М’ятний',
        '#eff6ff' => 'Блакитний',
        '#fffbeb' => 'Жовтий',
        '#faf5ff' => 'Бузковий',
        '#2d3436' => 'Темний'
    ];

    $currentColor = $_SESSION['bg_color'] ?? '#f9fafb';
    $message = '';
    $error = '';

    if ($this->request->isPost()) {
        $selected = $_POST['bg_color'] ?? '';
        if (array_key_exists($selected, $colors)) {
            $_SESSION['bg_color'] = $selected;
            $currentColor = $selected;
            $message = 'Колір успішно збережено!';
        } else {
            $error = 'Виберіть колір зі списку.';
        }
    }

    return $this->view->render('settings/color', [
        'colors' => $colors,
        'currentColor' => $currentColor,
        'message' => $message,
        'error' => $error
    ]);
}

    public function action_greeting(): void
    {
        $message = '';
        $error = '';

        if ($this->request->isPost()) {
            $name = trim($this->request->post('greeting_name', ''));
            $gender = $this->request->post('greeting_gender', '');

            if ($name === '') {
                $error = "Ім'я не може бути порожнім.";
            } elseif (!in_array($gender, ['male', 'female'], true)) {
                $error = 'Оберіть стать.';
            } else {
                setcookie('greeting_name', $name, time() + 30 * 24 * 3600, '/');
                setcookie('greeting_gender', $gender, time() + 30 * 24 * 3600, '/');

                $_COOKIE['greeting_name'] = $name;
                $_COOKIE['greeting_gender'] = $gender;

                $message = 'Привітання збережено в cookie!';
            }
        }

        $this->render('settings/greeting', [
            'message' => $message,
            'error' => $error,
            'currentName' => $_COOKIE['greeting_name'] ?? '',
            'currentGender' => $_COOKIE['greeting_gender'] ?? '',
        ], 'Привітання (Cookie)');
    }
}
