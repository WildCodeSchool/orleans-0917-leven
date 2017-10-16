<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 16/10/17
 * Time: 16:09
 */

namespace Leven\Model;


class ModelManager
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USERNAME, PASSWORD);
    }
}
