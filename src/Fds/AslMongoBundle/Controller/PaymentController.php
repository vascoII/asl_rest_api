<?php

namespace Fds\AslMongoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fds\AslMongoBundle\Document\Payment;
use Fds\AslMongoBundle\Form\PaymentType;

/**
 * Payment controller.
 */
class PaymentController extends Controller
{
    /**
     * Lists all Payment documents.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $dm = $this->getDocumentManager();

        $documents = $dm->getRepository('FdsAslMongoBundle:Payment')->findAll();

        return $this->render('FdsAslMongoBundle:Payment:index.html.twig', array('documents' => $documents));
    }

    /**
     * Displays a form to create a new Payment document.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $document = new Payment();
        $form = $this->createForm(new PaymentType(), $document);

        return $this->render('FdsAslMongoBundle:Payment:new.html.twig', array(
            'document' => $document,
            'form'     => $form->createView()
        ));
    }

    /**
     * Creates a new Payment document.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $document = new Payment();
        $form     = $this->createForm(new PaymentType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('payment_show', array('id' => $document->getId())));
        }

        return $this->render('FdsAslMongoBundle:Payment:new.html.twig', array(
            'document' => $document,
            'form'     => $form->createView()
        ));
    }

    /**
     * Finds and displays a Payment document.
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

        $document = $dm->getRepository('FdsAslMongoBundle:Payment')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Payment document.');
        }

        $deleteForm = $this->createDeleteForm($id);


        return $this->render('FdsAslMongoBundle:Payment:show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Payment document.
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

        $document = $dm->getRepository('FdsAslMongoBundle:Payment')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Payment document.');
        }

        $editForm = $this->createForm(new PaymentType(), $document);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FdsAslMongoBundle:Payment:edit.html.twig', array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Payment document.
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

        $document = $dm->getRepository('FdsAslMongoBundle:Payment')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Payment document.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new PaymentType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('payment_edit', array('id' => $id)));
        }

        return $this->render('FdsAslMongoBundle:Payment:edit.html.twig', array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Payment document.
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
            $document = $dm->getRepository('FdsAslMongoBundle:Payment')->find($id);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Payment document.');
            }

            $dm->remove($document);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('payment'));
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
