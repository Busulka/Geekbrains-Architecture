<?php

// соединение с базой

interface DBConnection {
    public function getConnection();
}

class MySQLDBConnection implements DBConnection {
    public function getConnection() {
    }
}

class PostgreSQLDBConnection implements DBConnection {
    public function getConnection() {
    }
}

class OracleDBConnection implements DBConnection {
    public function getConnection() {
    }
}


//запись таблицы базы данных

interface DBRecord {
    public function getRecord();
}

class MySQLDBRecord implements DBRecord {
    public function getRecord() {
    }
}

class PostgreSQLDBRecord implements DBRecord {
    public function getRecord() {
    }
}

class OracleDBRecord implements DBRecord {
    public function getRecord() {
    }
}


// конструктор запросов к базе

interface DBQueryBuilder {
    public function getQueryBuilder();
}

class MySQLDBQueryBuilder implements DBQueryBuilder {
    public function getQueryBuilder() {
    }
}

class PostgreSQLDBQueryBuilder implements DBQueryBuilder {
    public function getQueryBuilder() {
    }
}

class OracleDBQueryBuilder implements DBQueryBuilder {
    public function getQueryBuilder() {
    }
}

// Фабрики

interface AbstractFactory {
    public function createDBConnection(): DBConnection;

    public function createDBRecord(): DBRecord;

    public function createDBQueryBuilder(): DBQueryBuilder;
}


class MySQLFactory implements AbstractFactory {
    public function createDBConnection(): DBConnection {
        return new MySQLDBConnection();
    }

    public function createDBRecord(): DBRecord {
        return new MySQLDBRecord();
    }

    public function createDBQueryBuilder(): DBQueryBuilder {
        return new MySQLDBQueryBuilder();
    }
}


class PostgreSQLFactory implements AbstractFactory {
    public function createDBConnection(): DBConnection {
        return new PostgreSQLDBConnection();
    }

    public function createDBRecord(): DBRecord {
        return new PostgreSQLDBRecord();
    }

    public function createDBQueryBuilder(): DBQueryBuilder {
        return new PostgreSQLDBQueryBuilder();
    }
}

class OracleFactory implements AbstractFactory {
    public function createDBConnection(): DBConnection {
        return new OracleDBConnection();
    }

    public function createDBRecord(): DBRecord {
        return new OracleDBRecord();
    }

    public function createDBQueryBuilder(): DBQueryBuilder {
        return new OracleDBQueryBuilder();
    }
}

// Клиентский код

function clientCode(AbstractFactory $factory) {
    $DBConnection = $factory->createDBConnection();
    $DBRecord = $factory->createDBRecord();
    $DBQueryBuilder = $factory->createDBQueryBuilder();

    $DBConnection->getConnection();
    $DBRecord->getRecord();
    $DBQueryBuilder->getQueryBuilder();
}

clientCode(new MySQLFactory());
