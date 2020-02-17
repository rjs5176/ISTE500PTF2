<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/17/2020
 * Time: 12:41 PM
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

class UpdateWarehouseCommand implements Command
{
    private const PERMISSION = 'trs_warehouses-w';

    private $result = NULL;
    private $error = NULL;

    private $ware = NULL;
    private $args = NULL;

    public function __construct(Warehouse $ware, array $args)
    {
        $this->ware = $ware;
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

        // Validator
        try
        {
            Validator::validateClass('extensions\trs\models\Warehouse', Warehouse::FIELDS, $this->args);
        }
        catch(ValidationError $e)
        {
            $this->error = $e;
            return FALSE;
        }

        // History
        HistoryRecorder::writeHistory('TRS_Warehouse', HistoryRecorder::MODIFY, $this->ware->getId(), $this->ware, $this->ware);

        // Update
        WarehouseDatabaseHandler::update($this->ware->getId(), $this->args);

        return TRUE;
    }

    /**
     * @return mixed The output of a successful command, defined by the command
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