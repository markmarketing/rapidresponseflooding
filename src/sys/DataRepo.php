<?php

class DataRepo
{
    public static function query(string $query, $dbInstance, $qtype = 'SELECT', $singleRow = false)
    {
        if (empty($query)) return false;
        if (empty($dbInstance)) return false;

        $stmt = $dbInstance->prepare($query);        
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if ($qtype == 'INSERT') return 1;

        return ($singleRow) ? $stmt->fetch() : $stmt->fetchAll();
    }
}
