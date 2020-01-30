<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/28/2019
 * Time: 12:56 PM
 */


namespace views\content;


use views\View;

class Bulletin extends View
{
    /**
     * Bulletin constructor.
     * @param string $title
     * @param string $message
     * @param string $type
     * @throws \exceptions\ViewException
     */
    public function __construct(string $title, string $message, string $type)
    {
        $this->setTemplateFromHTML('Bulletin', self::TEMPLATE_CONTENT);

        $this->setVariable('title', $title);
        $this->setVariable('message', $message);
        $this->setVariable('type', ($type == 'a') ? 'alert' : 'info');

        $this->setVariable('icon', ($type == 'a') ? 'error.png' : 'about.png');
    }
}