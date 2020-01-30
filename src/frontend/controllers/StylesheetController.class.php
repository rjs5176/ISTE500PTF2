<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 10/31/2019
 * Time: 9:51 AM
 */


namespace controllers;


use views\pages\ScriptPage;
use views\View;

class StylesheetController extends Controller
{

    /**
     * @return View
     */
    public function getPage(): ?View
    {
        $scriptPath = dirname(__FILE__) . '/../';

        // Check for extension prefix
        $extension = $this->request->next();

        if(in_array($extension, \Config::OPTIONS['enabledExtensions']))
        {
            $scriptPath .= 'extensions/' . $extension . '/stylesheets';
        }
        else
        {
            $scriptPath .= 'stylesheets/' . $extension;
        }

        while($part = $this->request->next())
        {
            $scriptPath .= '/' . $part;
        }

        if(file_exists($scriptPath))
        {
            header('Content-type: text/css');
            return new ScriptPage($scriptPath);
        }

        return NULL;
    }
}