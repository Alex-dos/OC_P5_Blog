<?php

namespace App\Service;


abstract class Database
{
    const DB_HOST = '';
    const DB_USER = '';
    const DB_PASS = '';


    public function parseIni()
    {
        $conf = parse_ini_file(__DIR__ . '/../../config.ini', true);
        $this->DB_HOST = $conf['database']['host'];
        $this->DB_USER = $conf['database']['user'];
        $this->DB_PASS = $conf['database']['pass'];
    }

    private $connection;

    private function checkConnection()
    {
        if ($this->connection === null) {
            return $this->getConnection();
        }

        return $this->connection;
    }

    private function getConnection()
    {
        try {
            $this->parseIni();
            $this->connection = new \PDO($this->DB_HOST, $this->DB_USER, $this->DB_PASS);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $this->connection;
        } catch (\Exception $e) {
            $errorConnection = $e->getMessage();
            $_SESSION['errorMessage'] = $errorConnection;
            header('HTTP/1.1 404 Not Found');
            header('Location: /404');
        }
    }

    protected function sql($sql, $parameters = null, $bind = null)
    {
        if ($parameters || $bind) {
            $result = $this->getConnection()->prepare($sql);



            if ($bind) {
                foreach ($bind as $bindnew) {
                    $result->bindParam($bindnew[0], $bindnew[1], $bindnew[2]);
                }
                $result->execute();
            } else {
                $result->execute($parameters);
            }

            return $result;
        } else {
            $result = $this->getConnection()->query($sql);

            return $result;
        }
    }
}
