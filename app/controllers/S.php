<?php
    class S extends Controller {
        public function index($short) {
            $user = $this->model('Link');
            $link = $user->search_link($short);
            header('Location: ' . $link['link']);
        }
    }