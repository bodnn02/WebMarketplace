<?php 

class User {
    public $id;
    public $name;
    public $phone;
    public $login;
    public $reg_date;
    public $role;
    public $balance;
    public $payment_methods;
    public $rating;

    // Конструктор класса
    public function __construct($id, $name, $phone, $login, $reg_date, $role, $balance, $payment_methods, $rating) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->login = $login;
        $this->reg_date = $reg_date;
        $this->role = $role;
        $this->balance = $balance;
        $this->payment_methods = $payment_methods;
        $this->rating = $rating;
    }
}

?>