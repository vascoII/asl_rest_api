<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Property;
use Fds\AslMongoBundle\Form\PropertyType;

/**
 * Property controller.
 */
class PropertyController extends Controller
{
    /**
     * Lists all Property documents.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $dm = $this->getDocumentManager();

        $documents = $dm->getRepository('FdsAslMongoBundle:Property')->findAll();

        return $this->render('FdsAslMongoBundle:Property:index.html.twig', array('documents' => $documents));
    }

    /**
     * Displays a form to create a new Property document.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $document = new Property();
        $form = $this->createForm(new PropertyType(), $document);

        return $this->render('FdsAslMongoBundle:Property:new.html.twig', array(
            'document' => $document,
            'form'     => $form->createView()
        ));
    }

    /**
     * Creates a new Property document.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $document = new Property();
        $form     = $this->createForm(new PropertyType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('property_show', array('id' => $document->getId())));
        }

        return $this->render('FdsAslMongoBundle:Property:new.html.twig', array(
            'document' => $document,
            'form'     => $form->createView()
        ));
    }

    /**
     * Finds and displays a Property document.
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

        $document = $dm->getRepository('FdsAslMongoBundle:Property')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Property document.');
        }

        $deleteForm = $this->createDeleteForm($id);


        return $this->render('FdsAslMongoBundle:Property:show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Property document.
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

        $document = $dm->getRepository('FdsAslMongoBundle:Property')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Property document.');
        }

        $editForm = $this->createForm(new PropertyType(), $document);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FdsAslMongoBundle:Property:edit.html.twig', array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Property document.
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

        $document = $dm->getRepository('FdsAslMongoBundle:Property')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Property document.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new PropertyType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('property_edit', array('id' => $id)));
        }

        return $this->render('FdsAslMongoBundle:Property:edit.html.twig', array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Property document.
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
            $document = $dm->getRepository('FdsAslMongoBundle:Property')->find($id);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Property document.');
            }

            $dm->remove($document);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('property'));
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
