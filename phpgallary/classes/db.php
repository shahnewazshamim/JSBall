<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class db
{

    private $dsn;
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($hostname, $username, $password, $database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->dsn = "mysql:host={$this->hostname};dbname={$this->database}";
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->connection = new PDO($this->dsn, $this->username, $this->password);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function insert($table, $data)
    {
        $fields = '';
        $params = '';
        $vitems = '';
        $qsigns = array();
        $keys = new AddComma(new ArrayIterator(array_keys($data)));
        foreach ($keys as $key) {
            $fields .= $key;
            array_push($qsigns, '?');
        }
        $values = new AddComma(new ArrayIterator(array_values($data)));
        foreach ($values as $value) {
            $params .= $value;
        }
        $signs = new AddComma(new ArrayIterator(array_values($qsigns)));
        foreach ($signs as $sign) {
            $vitems .= $sign;
        }
        $stmt = $this->connection->prepare("INSERT INTO $table ($fields) VALUES ($vitems)");
        $stmt->execute(array_values($data));
    }

    public function getAll($table, $subQry = false)
    {
        if(!$subQry) {
            $stmt = $this->connection->prepare("SELECT * FROM $table WHERE is_active = 1");
        } else {
            $stmt = $this->connection->prepare("SELECT *, (SELECT title FROM $table AS p WHERE c.parent_id = p.id) as parent_title FROM $table AS c WHERE is_active = 1");
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function count($table)
    {
        $stmt = $this->connection->prepare("SELECT count(*) FROM $table WHERE is_active = 1");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

}