<?php


namespace App;

class DatabasePostgres
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
    private $db_port = "5432";

    /**
     * @return string
     */
    public function getDbPort(): string
    {
        return $this->db_port;
    }

    /**
     * @var string
     */
    private $db_user = "postgres";

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
    private $db_name = "postgres";

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
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
        //$this->setConnection($this->getDbHost(), $this->getDbUser(), $this->getDbPass(), $this->getDbName());
        $connection = pg_connect("
            host={$this->getDbHost()} 
            port={$this->getDbPort()} 
            dbname={$this->getDbName()} 
            user={$this->getDbUser()} 
            password={$this->getDbPass()}
            ");
        $query = "CREATE TABLE IF NOT EXISTS ".$db_table." (
                  id SERIAL PRIMARY KEY,
                  title VARCHAR(300) NOT NULL UNIQUE,
                  link VARCHAR(300) NOT NULL,
                  src_image VARCHAR(300) NOT NULL,
                  validity_text VARCHAR(100) NOT NULL,
                  validity_length INTEGER NOT NULL,
                  end_sale_date TIMESTAMP NOT NULL
                  )";
        $result = pg_query($connection, $query);
        if (!$result)
        {
            die("BAD CONNECTION WITH TABLE $db_table FROM {$this->getDbName()} ".pg_errormessage($connection));
        }
        $this->setDbTable($db_table);
        pg_close($connection);
    }

}