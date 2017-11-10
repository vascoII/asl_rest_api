<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Common controller.
 */
class CommonController extends Controller
{
    
    
    /**
     * @return DocumentManager
     */
    protected function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
    
    /*
     * @return integer last document identifier + one
     */
    protected function getIdPlusOneAdded($document)
    {
        $mongoService = 
            $this->container->get('fds_mongoservice.mongoservice');
        return $mongoService->getIdPlusOneAdded($document);
    }
    
    /**
     * @return FOSView 
     */
    protected function noDocumentFound($document)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->noDocumentFound($document);
    }
    
    /**
     * @return FOSView 
     */
    protected function documentRemoved($document)
    {
        $fosviewService = 
            $this->container->get('fds_fosviewservice.fosviewservice');
        return $fosviewService->documentRemoved($document);
    }
}
