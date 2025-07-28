<?php

class ContactsController extends Controller
{
    public function action(string $viewName): void
    {
        $errors = [];
        $success = null;
        $name = '';
        $email = '';
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name === '') {
                $errors['name'] = 'Имя обязательно';
            }
            if ($email === '') {
                $errors['email'] = 'Email обязателен';
            }
            if ($message === '') {
                $errors['message'] = 'Сообщение обязательно';
            }

            if (empty($errors)) {
                if (!is_dir('data')) {
                    mkdir('data');
                }
                file_put_contents('data/contacts.json', json_encode([
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'timestamp' => date('c'),
                ], JSON_PRETTY_PRINT), FILE_APPEND);
                $success = 'Форма успешно отправлена!';
                $name = $email = $message = '';
            }
        }

        $this->view->render('contacts', [
            'title' => 'Контактная форма',
            'errors' => $errors,
            'success' => $success,
            'old' => [
                'name' => $name,
                'email' => $email,
                'message' => $message,
            ],
        ]);
    }
}
