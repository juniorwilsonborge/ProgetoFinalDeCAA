<?php
class Node {
    public $elemento;
    public $next;

    public function __construct($elemento) {
        $this->elemento = $elemento;
        $this->next = null;
    }
}
?>