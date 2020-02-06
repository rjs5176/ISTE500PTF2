<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * APPLICATION
 *
 * DESCRIPTION
 *
 * User: jdk1061
 * Date: 2/06/2020
 * Time: 12:20 PM
 */


namespace extensions\trs\views\pages;


use views\pages\TRSDocument;

class TRSHomepage extends TRSDocument
{
    public function __construct(){
        parent..__construct('trs',NULL);
        $this->setVariable('content',templateFileContents('landing',TRSDocument::TEMPLATE_PAGE,'trs'));
    }
}