<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/17/2020
 * Time: 1:00 PM
 */


namespace extensions\trs\controllers;


use controllers\Controller;
use extensions\trs\commands\CreateWarehouseCommand;
use extensions\trs\commands\DeleteWarehouseCommand;
use extensions\trs\commands\GetWarehouseCommand;
use extensions\trs\commands\UpdateWaehouseCommand;
use extensions\trs\models\Warehouse;
use models\HTTPRequest;
use models\HTTPResponse;

class WarehouseController extends Controller
{
    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    private function getWarehouse($id): HTTPResponse
    {
        $get = new GetWarehouseCommand((int)$id);
        if($get->execute())
        {
            return new HTTPResponse(HTTPResponse::OK, $get->getResult()->toArray());
        }
        else
        {
            throw $get->getError();
        }
    }

    /**
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    private function createWarehouse(): HTTPResponse
    {
        $create = new CreateWarehouseCommand(self::getFormattedBody(Warehouse::FIELDS, TRUE));
        if($create->execute())
        {
            return new HTTPResponse(HTTPResponse::CREATED, array('id' => $create->getResult()->getId()));
        }
        else
            throw $create->getError();
    }

    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    private function deleteWarehouse($id): HTTPResponse
    {
        $org = new GetWarehouseCommand((int)$id);
        if(!$ware->execute())
            throw $ware->getError();

        $delete = new DeleteWarehouseCommand($ware->getResult());
        if($delete->execute())
            return new HTTPResponse(HTTPResponse::NO_CONTENT);
        else
            throw $delete->getError();
    }

    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\EntryNotFoundException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    private function updateWarehouse($id): HTTPResponse
    {
        $org = new GetWarehouseCommand((int)$id);
        if(!$ware->execute())
            throw $ware->getError();

        $update = new UpdateWarehouseCommand($ware->getResult(), self::getFormattedBody(Warehouse::FIELDS, TRUE));
        if($update->execute())
            return new HTTPResponse(HTTPResponse::NO_CONTENT);
        else
            throw $update->getError();
    }
}