<?php
    class Error404 extends Controller {
        public function index() {
            $data = [
                'title' => 'Ошибка 404. Страница не существует',
                'description' => 'Ошибка 404. Страница не существует',
                'css' => ''
            ];
            $this->view('home/404', $data);
        }
    }