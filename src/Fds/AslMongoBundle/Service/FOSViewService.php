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
}