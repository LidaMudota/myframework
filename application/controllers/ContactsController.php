<?php
class ContactsController extends Controller
{
    public function action(string $viewName): void
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->handleForm();
        }
        $this->view->render('contacts', $data);
    }

    private function handleForm(): array
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        $errors = [];
        if ($name === '') {
            $errors[] = 'Введите имя';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Неверный email';
        }
        if ($message === '') {
            $errors[] = 'Введите сообщение';
        }

        if (!$errors) {
            $file = __DIR__ . '/../data/contacts.json';
            if (!is_dir(dirname($file))) {
                mkdir(dirname($file), 0777, true);
            }
            $records = [];
            if (file_exists($file)) {
                $records = json_decode(file_get_contents($file), true) ?: [];
            }
            $records[] = ['name' => $name, 'email' => $email, 'message' => $message, 'date' => date('Y-m-d H:i:s')];
            file_put_contents($file, json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return ['success' => 'Сообщение отправлено'];
        }

        return ['errors' => $errors, 'name' => $name, 'email' => $email, 'message' => $message];
    }
}