<?php

namespace Fds\AslMongoBundle\Service;

use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpFoundation\Response;

/**
 * FOSView Service
 */
class FOSViewService
{
    /**
     * @return FOSView 
     */
    public function noDocumentFound($document)
    {
        return FOSView::create(
            ['message' => 'No '.$document.' found'], 
            Response::HTTP_NOT_FOUND
        );
    }
    
    /**
     * @return FOSView 
     */
    public function documentRemoved($document)
    {
        return FOSView::create(
            ['message' => $document.' removed'], 
            Response::HTTP_ACCEPTED
        );
    }
    
    /**
     * @return FOSView 
     */
    public function documentRemoveNotAllowed($document, $childrens)
    {
        return FOSView::create(
            [
                'message' => 
                $document.' can not be removed : Remove '.$childrens.' before'], 
            Response::HTTP_FORBIDDEN
        );
    }
}