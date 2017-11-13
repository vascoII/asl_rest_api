<?php

namespace Fds\AslMongoBundle\Service;

use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpFoundation\Response;

/**
 * FOSView Service
 */
class FOSViewService
{
    /*
     * POST_Create :: 201
     * @return FOSView
     */
    public function postCreate($url)
    {
        return FOSView::create(null, Response::HTTP_CREATED, ['Location' => $url]);
    }
    
    /*
     * POST_CreateViewer :: 202
     * @return FOSView
     */
    public function postCreateUser($data)
    {
        return FOSView::create($data, Response::HTTP_ACCEPTED);
    }
    
    /*
     * GET_Read :: 200
     * @return FOSView
     */
    public function getRead($data)
    {
        return FOSView::create($data, Response::HTTP_OK);
    }
    
    /*
     * PATCH_Update/Modify :: 200
     * @return FOSView
     */
    public function patchUpdateModify()
    {
        return FOSView::create(null, Response::HTTP_OK);
    }
    
    /*
     * DELETE_Delete :: 200
     * @return FOSView
     */
    public function deleteDelete()
    {
        return FOSView::create(null, Response::HTTP_OK);
    }
    
    /*
     * Not Found :: 404
     * @return FOSView
     */
    public function notFound($document)
    {
        return FOSView::create(
            ['message' => $document.' not found'], 
            Response::HTTP_NOT_FOUND
        );
    }
    
    /*
     * Conflict :: 409 if resource already exists..
     * @return FOSView
     */
    public function conflict($data)
    {
        return FOSView::create($data, Response::HTTP_CONFLICT);
    }
    
    /*
     * Method Not Allowed :: 405
     * @return FOSView
     */
    
    /**
     * @return FOSView 
     */
    public function documentTracked($document)
    {
        return FOSView::create(
            ['message' => $document.' tracked'], 
            Response::HTTP_OK
        );
    }
    
}