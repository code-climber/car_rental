<?php

    namespace car_rental\model\dao;

    /**
     * Class DBOperation.
     * DataBase operation.
     *
     * @package ecommerce\db
     */
    class DBOperation
    {
        const HOST = 'localhost';
        const USER = 'root';
        const PWD = '';
        const NAME = 'car_rental';

        /**
         * @var \PDO database.
         */
        private static $oDataBase = null;

        /**
         * Initialize the DataBase connection.
         */
        private static function init()
        {
            if (null === self::$oDataBase) {
                self::$oDataBase = new \PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PWD);
                self::$oDataBase->exec("SET CHARACTER SET utf8");
                self::$oDataBase->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
                self::$oDataBase->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        }

        /**
         * Get all results from a query.
         *
         * @param $sQuery query to execute.
         *
         * @return array all results.
         */
        public static function getAll($sQuery,$bindParam)
        {
            self::init();
            
            try {
                $aAll = array();
                $stmt = self::$oDataBase->prepare($sQuery);
                $stmt->execute($bindParam);
                foreach ($stmt as $aRow) {
                    $aAll[] = $aRow;
                }
            } catch (\PDOException $oPdoException) {
                echo 'PDO Exception : ' . $oPdoException->getMessage();
            }
            return $aAll;
        }

        /**
         * Get a single row from a query.
         *
         * @param $sQuery query to execute.
         *
         * @return array single row.
         */
        public static function getOne($sQuery,$bindParam)
        {
            self::init();
            try {
                $stmt = self::$oDataBase->prepare($sQuery);
                $stmt->execute($bindParam) or die(print_r(self::$oDataBase->errorInfo()));
                $aRow = $stmt->fetch();

            } catch (PDOException $oPdoException) {
                echo 'PDO Exception : ' . $oPdoException->getMessage();
            }
            return $aRow;
        }

        /**
         * Execute a query. Used for insert/update/delete queries.
         *
         * @param $sQuery query to execute.
         *
         * @return bool true if success, false otherwise.
         */
        public static function exec($sQuery,$aQueryParams)
        {
            self::init();
            try {
                
                $stmt = self::$oDataBase->prepare($sQuery);
                
//                foreach($aQueryParams as $key => &$value){
//                    $stmt->bindParam($key, $value);
//                }
                $iAffectedRows = $stmt->execute($aQueryParams) or die(print_r(self::$oDataBase->errorInfo()));
            } catch (PDOException $oPdoException) {
                echo 'PDO Exception : ' . $oPdoException->getMessage();
            }
            return false !== $iAffectedRows;
        }

        public static function getLastId()
        {
            return self::$oDataBase->lastInsertId();
        }
    }