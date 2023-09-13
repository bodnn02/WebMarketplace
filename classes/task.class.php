<?php 

class Task {
    // Свойства объекта Task
    public $id;
    public $name;
    public $place;
    public $type;
    public $misc;
    public $price;
    public $status;
    public $owner_id;

    // Конструктор класса
    public function __construct($id, $name, $place, $type, $misc, $price, $status, $owner_id) {
        $this->id = $id;
        $this->name = $name;
        $this->place = $place;
        $this->type = $type;
        $this->misc = $misc;
        $this->price = $price;
        $this->status = $status;
        $this->owner_id = $owner_id;
    }

    // Метод для вывода информации о задаче
    public function getTaskInfo() {
        return "ID: {$this->id}, Name: {$this->name}, Place: {$this->place}, Type: {$this->type}, Misc: {$this->misc}, Price: {$this->price}, Status: {$this->status}, Owner ID: {$this->owner_id}";
    }
}


?>