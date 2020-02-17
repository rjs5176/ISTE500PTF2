<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/17/2020
 * Time: 12:28 PM
 */


namespace extensions\trs\commands;


use commands\Command;
use controllers\CurrentUserController;
use exceptions\MercuryException;
use extensions\trs\database\WarehouseDatabaseHandler;
use extensions\trs\models\Warehouse;
use utilities\HistoryRecorder;

class DeleteWarehouseCommand implements Command
{
    private const PERMISSION = 'trs_warehouses-w';

    private $result = NULL;
    private $error = NULL;

    private $ware; // Warehouse object

    /**
     * DeleteWarehouseCommand constructor.
     * @param Warehouse $ware
     */
    public function __construct(Warehouse $ware)
    {
        $this->ware = $ware;
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

        // History
        HistoryRecorder::writeHistory('TRS_Warehouse', HistoryRecorder::DELETE, $this->ware->getId(), $this->ware);

        // Delete
        $this->result = WarehouseDatabaseHandler::delete($this->ware->id);

        return $this->result;
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