<?php

class ContactsController extends Controller
{
    public function action_index()
    {
        $errors = [];
        $success = false;
        $form = ['name' => '', 'email' => '', 'message' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form['name'] = trim($_POST['name'] ?? '');
            $form['email'] = trim($_POST['email'] ?? '');
            $form['message'] = trim($_POST['message'] ?? '');

            if ($form['name'] === '') $errors[] = 'Имя обязательно';
            if ($form['email'] === '') $errors[] = 'Email обязателен';
            if ($form['message'] === '') $errors[] = 'Сообщение обязательно';

            if (empty($errors)) {
                $data = $form + ['timestamp' => date('c')];
                if (!file_exists('data')) mkdir('data');
                file_put_contents('data/contacts.json', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);
                $success = true;
                $form = ['name' => '', 'email' => '', 'message' => ''];
            }
        }

        $this->view->render('contacts', [
            'title' => 'Контактная форма',
            'errors' => $errors,
            'success' => $success,
            'form' => $form
        ]);
    }
}
