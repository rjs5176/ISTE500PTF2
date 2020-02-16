<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/16/2020
 * Time: PM
 */


namespace extensions\trs\database;


use database\DatabaseConnection;
use database\DatabaseHandler;
use database\PreparedStatement;
use exceptions\EntryNotFoundException;
use extensions\trs\models\Warehouse;

class WarehouseDatabaseHandler extends DatabaseHandler
{
    /**
     * Select a single Warehouse by ID
     * @param int $id Numerical ID of the Warehouse
     * @return Warehouse
     * @throws EntryNotFoundException The ID was not found
     * @throws \exceptions\DatabaseException
     */
    public static function selectById(int $id): Warehouse
    {
        $c = new DatabaseConnection();

        $s = $c->prepare('SELECT `id`, `name`, `address` FROM `TRS_Warehouse` WHERE `id` = ? LIMIT 1');
        $s->bindParam(1, $id, DatabaseConnection::PARAM_INT);
        $s->execute();

        $c->close();

        if($s->getRowCount() !== 1)
            throw new EntryNotFoundException(EntryNotFoundException::MESSAGES[EntryNotFoundException::PRIMARY_KEY_NOT_FOUND], EntryNotFoundException::PRIMARY_KEY_NOT_FOUND);

        return $s->fetchObject('extensions\trs\models\Warehouse');
    }

	
    /**
     * @param array $args Assoc array of all parameters and their values
     * @return Warehouse
     * @throws EntryNotFoundException
     * @throws \exceptions\DatabaseException
     */
    public static function insert(array $args): Warehouse
    {
        $c = new DatabaseConnection();

        $i = $c->prepare(PreparedStatement::buildQueryString('TRS_Warehouse', PreparedStatement::INSERT, Warehouse::FIELDS));

        $i->bindParams($args);

        $i->execute();

        $id = $c->getLastInsertId();


        $c->close();

        return self::selectById($id);
    }

    /**
     * @param int $id
     * @param array $args
     * @return Organization
     * @throws EntryNotFoundException
     * @throws \exceptions\DatabaseException
     */
    public static function update(int $id, array $args): Warehouse
    {
        $c = new DatabaseConnection();

        $u = $c->prepare(PreparedStatement::buildQueryString('TRS_Warehouse', PreparedStatement::UPDATE, Warehouse::FIELDS));

        $u->bindParams(array_merge($args, array('id' => $id)));

        $u->execute();

        $c->close();

        return self::selectById($id);
    }

    /**
     * @param int $id
     * @return bool
     * @throws \exceptions\DatabaseException
     */
    public static function delete(int $id): bool
    {
        $c = new DatabaseConnection();

        $d = $c->prepare('DELETE FROM `TRS_Warehouse` WHERE `id` = ?');
        $d->bindParam(1, $id, DatabaseConnection::PARAM_INT);
        $d->execute();

        $c->close();

        return $d->getRowCount() === 1;
    }
}