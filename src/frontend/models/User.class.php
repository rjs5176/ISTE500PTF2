<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 5:54 PM
 */


namespace models;


class User
{
    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $authType;

    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->username = $attributes['username'];
        $this->firstName = $attributes['firstName'];
        $this->lastName = $attributes['lastName'];
        $this->email = $attributes['email'];
        $this->authType = $attributes['authType'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAuthType(): string
    {
        return $this->authType;
    }


}