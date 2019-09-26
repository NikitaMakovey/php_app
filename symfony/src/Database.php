<?php


namespace App;

class Database
{
    /**
     * @var string
     */
    private $db_host = "localhost";

    /**
     * @return string
     */
    public function getDbHost(): string
    {
        return $this->db_host;
    }

    /**
     * @var string
     */
    private $db_user = "root";

    /**
     * @return string
     */
    public function getDbUser(): string
    {
        return $this->db_user;
    }

    /**
     * @var string
     */
    private $db_pass = "Aa3sdf&&";

    /**
     * @return string
     */
    public function getDbPass(): string
    {
        return $this->db_pass;
    }

    /**
     * @var string
     */
    private $db_name = "lovikupon";

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @var \mysqli
     */
    private $connection;

    /**
     * @param $host
     * @param $user
     * @param $pass
     * @param $name
     */
    public function setConnection($host, $user, $pass, $name): void
    {
        $connection = new \mysqli($host, $user, $pass);
        if ($connection->connect_error)
        {
            die("DATABASE IS NOT CONNECTED");
        }
        $query = "CREATE SCHEMA IF NOT EXISTS ".$name;
        if ($connection->query($query) === TRUE)
        {
            $connection->connect($host, $user, $pass, $name);
            $this->connection = $connection;
        }
    }

    /**
     * @return \mysqli
     */
    public function getConnection(): \mysqli
    {
        return $this->connection;
    }

    /**
     * @var string
     */
    private $db_table = "vladivostok";

    /**
     * @return string
     */
    public function getDbTable(): string
    {
        return $this->db_table;
    }

    /**
     * @param string $db_table
     */
    public function setDbTable(string $db_table): void
    {
        $this->db_table = $db_table;
    }

    /**
     * Database constructor.
     * @param $db_table
     */
    public function __construct($db_table)
    {
        $this->setConnection($this->getDbHost(), $this->getDbUser(), $this->getDbPass(), $this->getDbName());
        $connection = $this->getConnection();
        $query = "CREATE TABLE IF NOT EXISTS ".$db_table." (
                  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                  title VARCHAR(300) NOT NULL,
                  link VARCHAR(300) NOT NULL,
                  src_image VARCHAR(300) NOT NULL,
                  validity_text VARCHAR(100) NOT NULL,
                  validity_length INT NOT NULL,
                  end_sale_date TIMESTAMP NOT NULL
                  ) DEFAULT CHARSET=utf8";
        if ($connection->query($query) !== TRUE)
        {
            die("BAD CONNECTION WITH TABLE $db_table FROM {$this->getDbName()} ".$connection->error);
        }
        $this->setDbTable($db_table);
        $connection->close();
    }

}