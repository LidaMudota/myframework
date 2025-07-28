<?php

class ContactsController extends Controller
{
    public function action_index()
    {
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name === '') $errors[] = 'Имя обязательно';
            if ($email === '') $errors[] = 'Email обязателен';
            if ($message === '') $errors[] = 'Сообщение обязательно';

            if (empty($errors)) {
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'timestamp' => date('c')
                ];
                if (!file_exists('data')) mkdir('data');
                file_put_contents('data/contacts.json', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);
                $success = true;
            }
        }

        $this->view->render('contacts', [
            'errors' => $errors,
            'success' => $success
        ]);
    }
}
