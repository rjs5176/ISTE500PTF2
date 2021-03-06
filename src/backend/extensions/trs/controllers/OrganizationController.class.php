<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 3:35 PM
 */


namespace extensions\trs\controllers;


use controllers\Controller;
use extensions\trs\commands\AddRepresentativeCommand;
use extensions\trs\commands\CreateOrganizationCommand;
use extensions\trs\commands\DeleteOrganizationCommand;
use extensions\trs\commands\GetOrganizationCommand;
use extensions\trs\commands\GetRepresentativesCommand;
use extensions\trs\commands\RemoveRepresentativeCommand;
use extensions\trs\commands\SearchOrganizationsCommand;
use extensions\trs\commands\UpdateOrganizationCommand;
use extensions\trs\models\Organization;
use models\HTTPRequest;
use models\HTTPResponse;

class OrganizationController extends Controller
{

    /**
     * @return HTTPResponse|null
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    public function getResponse(): ?HTTPResponse
    {
        $p1 = $this->request->next(); // First parameter in URL
        $p2 = $this->request->next();

        if($this->request->method() === HTTPRequest::GET)
        {
            if($p1 === NULL)
                return $this->searchOrganizations();
            else if($p1 !== NULL AND $p2 === 'representatives')
                return $this->getRepresentatives($p1);
            else
                return $this->getOrganization($p1);
        }
        else if($this->request->method() === HTTPRequest::POST)
        {
            if($p1 === 'search')
                return $this->searchOrganizations();
            else if($p1 !== NULL AND $p2 === 'representatives')
                return $this->addRepresentative($p1);
            else if($p1 === NULL)
                return $this->createOrganization();
        }
        else if($this->request->method() === HTTPRequest::DELETE)
        {
            if($p1 !== NULL AND $p2 === NULL)
                return $this->deleteOrganization($p1);
            else if($p1 !== NULL AND $p2 !== NULL)
                return $this->removeRepresentative($p1);
        }
        else if($this->request->method() === HTTPRequest::PUT)
        {
            if($p1 !== NULL)
            {
                return $this->updateOrganization($p1);
            }
        }

        return NULL;
    }

    /**
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\SecurityException
     */
    private function searchOrganizations(): HTTPResponse
    {
        $search = new SearchOrganizationsCommand(self::getFormattedBody(SearchOrganizationsCommand::PARAMS, FALSE));
        $search->execute();

        $results = array();

        foreach($search->getResult() as $organization)
        {
            $results[] = $organization->toArray();
        }

        return new HTTPResponse(HTTPResponse::OK, $results);
    }

    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    private function getOrganization($id): HTTPResponse
    {
        $get = new GetOrganizationCommand((int)$id);
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
    private function createOrganization(): HTTPResponse
    {
        $create = new CreateOrganizationCommand(self::getFormattedBody(Organization::FIELDS, TRUE));
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
    private function deleteOrganization($id): HTTPResponse
    {
        $org = new GetOrganizationCommand((int)$id);
        if(!$org->execute())
            throw $org->getError();

        $delete = new DeleteOrganizationCommand($org->getResult());
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
    private function updateOrganization($id): HTTPResponse
    {
        $org = new GetOrganizationCommand((int)$id);
        if(!$org->execute())
            throw $org->getError();

        $update = new UpdateOrganizationCommand($org->getResult(), self::getFormattedBody(Organization::FIELDS, TRUE));
        if($update->execute())
            return new HTTPResponse(HTTPResponse::NO_CONTENT);
        else
            throw $update->getError();
    }

    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     */
    private function getRepresentatives($id): HTTPResponse
    {
        $org = new GetOrganizationCommand((int)$id);
        if(!$org->execute())
            throw $org->getError();

        $reps = new GetRepresentativesCommand($org->getResult());
        if(!$reps->execute())
            throw $reps->getError();

        $data = array();

        foreach($reps->getResult() as $rep)
        {
            $data[] = array(
                'username' => $rep->getUsername(),
                'firstName' => $rep->getFirstName(),
                'lastName' => $rep->getLastName(),
                'email' => $rep->getEmail()
            );
        }

        return new HTTPResponse(HTTPResponse::OK, $data);
    }

    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ValidationError
     */
    private function addRepresentative($id): HTTPResponse
    {
        $org = new GetOrganizationCommand((int)$id);
        if(!$org->execute())
            throw $org->getError();

        $add = new AddRepresentativeCommand($org->getResult(), (string)self::getFormattedBody(array('username'), TRUE)['username']);
        if(!$add->execute())
            throw $add->getError();

        return new HTTPResponse(HTTPResponse::NO_CONTENT);
    }

    /**
     * @param $id
     * @return HTTPResponse
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\MercuryException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ValidationError
     */
    private function removeRepresentative($id): HTTPResponse
    {
        $org = new GetOrganizationCommand((int)$id);
        if(!$org->execute())
            throw $org->getError();

        $add = new RemoveRepresentativeCommand($org->getResult(), (string)self::getFormattedBody(array('username'), TRUE)['username']);
        if(!$add->execute())
            throw $add->getError();

        return new HTTPResponse(HTTPResponse::NO_CONTENT);
    }
}