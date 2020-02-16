<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * INS WEBNOC API
 *
 * User: rjs5176
 * Date: 2/16/2020
 * Time: 12:09 PM
 */


namespace extensions\trs\models;


use models\Model;
use utilities\Validator;

class Warehouse extends Model
{
    // Database fields
    public const FIELDS = array(
        'name',
        'address'
    );

    // Name Rules
    private const NAME_RULES = array(
        'name' => 'Name',
        'lower' => 1
    );

    public $id;
    public $name;
    public $address

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
    public function getName(): string
    {
        return $this->name;
    }
	
	/**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string|null $name
     * @return bool
     * @throws \exceptions\DatabaseException
     * @throws \exceptions\ValidationException
     */
    public static function validateName(?string $name): bool
    {
        return Validator::validate(self::NAME_RULES, $name);
    }
}