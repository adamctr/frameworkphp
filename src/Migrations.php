<?php

class Migrations
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    protected function columnExists($table, $column)
    {
        $result = $this->db->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
        return $result->fetch() !== false;
    }

    protected function addColumnIfNotExists($table, $column, $type, $options = '')
    {
        if (!$this->columnExists($table, $column)) {
            $sql = "ALTER TABLE `$table` ADD COLUMN `$column` $type $options";
            $this->db->exec($sql);
            error_log("Migration appliquée : Ajout de la colonne '$column' à la table '$table'.\n");
        } else {
            error_log("La colonne '$column' existe déjà dans la table '$table'.\n");
        }
    }

    protected function removeColumnIfExists($table, $column)
    {
        if ($this->columnExists($table, $column)) {
            $sql = "ALTER TABLE `$table` DROP COLUMN `$column`";
            $this->db->exec($sql);
            error_log("Migration appliquée : Suppression de la colonne '$column' de la table '$table'.\n");
        } else {
            error_log("La colonne '$column' n'existe pas dans la table '$table'.\n");
        }
    }

    public function migrate()
    {

    }
}
