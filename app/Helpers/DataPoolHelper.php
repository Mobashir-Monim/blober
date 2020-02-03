<?php

namespace App\Helpers;

use App\DataPool as DP;
use App\Table;

class DataPoolHelper extends Helper
{
    protected $name;
    protected $names;
    protected $tables;

    public function __construct($name, $names, $tables)
    {
        $this->name = $name;
        $this->names = $names;
        $this->tables = $tables;
    }

    public function createTablesWithValues()
    {
        $this->createTables($this->generateCreateStatements());
        $this->insertIntoTable($this->generateInsertStatements());

        return;
    }

    public function createDataPoolsWithTables()
    {
        $pool = DP::create(['name' => $this->name]);
        $tables = Table::createMultipleTables($this->names);

        foreach ($tables as $table) {
            $pool->tables()->attach($table->id);
        }
    }

    public function generateCreateStatements()
    {
        $createStatement = array();

        foreach ($this->names as $key => $name) {
            $createStatement[$key] = 'create table ' . $name . '(';

            for ($i = 0; $i < sizeof($this->tables[$key][0]); $i++) {
                $createStatement[$key] .= $this->tables[$key][0][$i] . ' ' . $this->tables[$key][1][$i] . (sizeof($this->tables[$key][0]) - 1 == $i ? ');' : ', ');
            }
        }

        return $createStatement;
    }

    public function createTables($createStatements)
    {
        foreach ($createStatements as $statement) {
            \DB::statement($statement);
        }
    }

    public function isStringable($string)
    {
        $string = strtolower($string);

        return $this->startsWith($string, 'char') || $this->startsWith($string, 'varchar') || $this->startsWith($string, 'date') || $this->startsWith($string, 'time');
    }

    public function generateInsertStatements()
    {
        $insertStatements = array();

        foreach ($this->tables as $tableKey => $table) {
            array_push($insertStatements, $this->generateTableInserts($tableKey, $table));
        }

        return $insertStatements;
    }

    public function generateTableInserts($tableKey, $table)
    {
        $tableInserts = array();

        for ($i = 2; $i < sizeof($table); $i++) {
            $tableInserts[$i - 2] = "insert into " . $this->names[$tableKey] . " values(";

            foreach ($table[$i] as $key => $col) {
                $tableInserts[$i - 2] .=
                    ($this->isStringable($table[1][$key]) && !$this->startsWith(strtolower($col), 'null') ? "'$col'" : "$col") .
                    ($key == sizeof($table[$i]) - 1 ? ');' : ', ');
            }
        }

        return $tableInserts;
    }

    public function insertIntoTable($insertStatements)
    {
        foreach ($insertStatements as $statements) {
            foreach ($statements as $statement) {
                \DB::statement($statement);
            }
        }
    }
}