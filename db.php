<?php

class DBConnect {
    protected $STATUS_FIRED = ['Fired', 1];
    protected $STATUS_UNFIRED = ['Not Fired', 0];

    private function getConnection() {
        $db = new PDO('sqlite:database/firings.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public function setStatus($status, $name) {
        $db = $this->getConnection();
        $ip = $_SERVER['REMOTE_ADDR'];
        $emp_status = ($status ? $this->STATUS_FIRED : $this->STATUS_UNFIRED);
        $query = "INSERT INTO Firings (Status, Status_code, Name, Ip) VALUES ('${emp_status[0]}', '${emp_status[1]}', '${name}', '${ip}')";
        $statement = $db->prepare($query);
        return $statement->execute();
    }

    public function getStatus() {
        $db = $this->getConnection();
        $statement = $db->prepare("SELECT * FROM Firings ORDER BY timestamp DESC LIMIT 1;");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getStatusById($id) {
        $db = $this->getConnection();
        $statement = $db->prepare("SELECT * FROM Firings WHERE id = ${id} ORDER BY timestamp DESC LIMIT 1;");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllStatuses() {
        $db = $this->getConnection();
        $statement = $db->prepare("SELECT * FROM Firings ORDER BY timestamp DESC;");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
