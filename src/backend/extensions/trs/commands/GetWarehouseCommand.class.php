<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/17/2020
 * Time: 12:36 PM
 */


namespace extensions\trs\commands;


use commands\Command;
use controllers\CurrentUserController;
use exceptions\EntryNotFoundException;
use exceptions\MercuryException;
use extensions\trs\database\WarehouseDatabaseHandler;
use extensions\trs\models\Warehouse;

class GetWarehouseCommand implements Command
{

    private const PERMISSION = 'trs_warehouses-r';

    private $id;
    private $result = NULL;
    private $error = NULL;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Executes the instructions of the command
     * @return bool Was the command successful?
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\SecurityException
     */
    public function execute(): bool
    {
        CurrentUserController::validatePermission(self::PERMISSION);

        try
        {
            $this->result = WarehouseDatabaseHandler::selectById($this->id);
        }
        catch(EntryNotFoundException $e)
        {
            $this->error = $e;
            return FALSE;
        }

        return TRUE;
    }

    /**
     * @return Warehouse|null The output of a successful command, defined by the command
     */
    public function getResult(): ?Warehouse
    {
        return $this->result;
    }

    /**
     * @return MercuryException|null An array of error messages
     */
    public function getError(): ?MercuryException
    {
        return $this->error;
    }
}