<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/17/2020
 * Time: 12:23 PM
 */


namespace extensions\trs\commands;


use commands\Command;
use controllers\CurrentUserController;
use exceptions\MercuryException;
use exceptions\ValidationError;
use extensions\trs\database\WarehouseDatabaseHandler;
use extensions\trs\models\Warehouse;
use utilities\HistoryRecorder;
use utilities\Validator;

class CreateWarehouseCommand implements Command
{
    private const PERMISSION = 'trs_warehouses-w';

    private $args = array();

    private $result = NULL;
    private $error = NULL;

    /**
     * CreateWarehouseCommand constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->args = $args;
    }

    /**
     * Executes the instructions of the command
     * @return bool Was the command successful?
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\SecurityException
     */
    public function execute(): bool
    {
        CurrentUserController::validatePermission(self::PERMISSION);

        // Validate fields against Organization class
        try
        {
            Validator::validateClass('extensions\trs\models\Warehouse', Warehouse::FIELDS, $this->args);
        }
        catch(ValidationError $e)
        {
            $this->error = $e;
            return FALSE;
        }

        // Create Warehouse
        $ware = WarehouseDatabaseHandler::insert($this->args);

        // Create History record
        HistoryRecorder::writeHistory('TRS_Warehouse', HistoryRecorder::CREATE, $ware->getId(), $ware);

        $this->result = $ware;

        return TRUE;
    }

    /**
     * @return Warehouse The output of a successful command, defined by the command
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return MercuryException|null The exception thrown by execution
     */
    public function getError(): ?MercuryException
    {
        return $this->error;
    }
}