<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 10:08 AM
 */


namespace views\pages;


use views\View;

abstract class HTML5Document extends View
{
    /**
     * HTML5Document constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML("HTML5Document", self::TEMPLATE_PAGE);

        // Check for custom styles
        if(\Config::OPTIONS['useCustomStyles'] === TRUE)
            $this->loadCustomStyles();

    }

    /**
     * Apply the custom stylesheet
     */
    protected function loadCustomStyles()
    {
        $this->setVariable('customSheets', "<link rel='stylesheet' href='" . \Config::OPTIONS['baseURI'] . "stylesheets/customtheme.css'>");
    }

    /**
     * Add additional stylesheets to this document
     * @param string | array $sheets
     */
    protected function addStylesheets($sheets)
    {
        if(!is_array($sheets))
        {
            $sheets = array((string)$sheets);
        }

        $styleString = '';

        foreach($sheets as $sheet)
        {
            $styleString .= "<link rel='stylesheet' href='" . \Config::OPTIONS['baseURI'] . "stylesheets/$sheet'>";
        }

        $this->setVariable('additionalSheets', $styleString);
    }
}