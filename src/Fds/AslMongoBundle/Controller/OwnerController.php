<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Fds\AslMongoBundle\Document\Owner;
use Fds\AslMongoBundle\Form\OwnerType;

/**
 * Owner controller.
 */
class OwnerController extends CommonController
{
    /**
     * Lists all Owner documents.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $dm = $this->getDocumentManager();

        $documents = $dm->getRepository('FdsAslMongoBundle:Owner')->findAll();

        return $this->render('FdsAslMongoBundle:Owner:index.html.twig', array('documents' => $documents));
    }

    /**
     * Displays a form to create a new Owner document.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $document = new Owner();
        $form = $this->createForm(new OwnerType(), $document);

        return $this->render('FdsAslMongoBundle:Owner:new.html.twig', array(
            'document' => $document,
            'form'     => $form->createView()
        ));
    }

    /**
     * Creates a new Owner document.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $document = new Owner();
        $form     = $this->createForm(new OwnerType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('owner_show', array('id' => $document->getId())));
        }

        return $this->render('FdsAslMongoBundle:Owner:new.html.twig', array(
            'document' => $document,
            'form'     => $form->createView()
        ));
    }

    /**
     * Finds and displays a Owner document.
     *
     * @param string $id The document ID
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function showAction($id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('FdsAslMongoBundle:Owner')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Owner document.');
        }

        $deleteForm = $this->createDeleteForm($id);


        return $this->render('FdsAslMongoBundle:Owner:show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Owner document.
     *
     * @param string $id The document ID
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function editAction($id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('FdsAslMongoBundle:Owner')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Owner document.');
        }

        $editForm = $this->createForm(new OwnerType(), $document);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FdsAslMongoBundle:Owner:edit.html.twig', array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Owner document.
     *
     * @param Request $request The request object
     * @param string $id       The document ID
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function updateAction(Request $request, $id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('FdsAslMongoBundle:Owner')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Owner document.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new OwnerType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('owner_edit', array('id' => $id)));
        }

        return $this->render('FdsAslMongoBundle:Owner:edit.html.twig', array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Owner document.
     *
     * @param Request $request The request object
     * @param string $id       The document ID
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $document = $dm->getRepository('FdsAslMongoBundle:Owner')->find($id);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Owner document.');
            }

            $dm->remove($document);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('owner'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Returns the DocumentManager
     *
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
