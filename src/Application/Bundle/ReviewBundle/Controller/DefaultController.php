<?php

namespace Application\Bundle\ReviewBundle\Controller;

use Application\Bundle\ReviewBundle\Entity\Review;
use Application\Bundle\ReviewBundle\Form\ReviewType;
use Sylius\Bundle\CoreBundle\Model\Product;
use Sylius\Bundle\CoreBundle\SyliusCoreBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Product $product)
    {
        $user = $this->getUser();

        $formView = null;
        $review = new Review();
        $review->setProduct($product);

        if ($user) {
            $form = $this->createForm(new ReviewType(), $review, array('action' => $this->generateUrl('application_review_save')));

            $formView = $form->createView();
        }

        $repository = $this->getDoctrine()->getRepository('ApplicationReviewBundle:Review');

        $reviews = $repository->findBy(array('product' => $product));

        return $this->render('ApplicationReviewBundle:Default:index.html.twig', array('reviews' => $reviews, 'product' => $product, 'form' => $formView));
    }

    public function saveReviewAction()
    {
        $user = $this->getUser();
        if ($user) {
            if ($this->getRequest()->getMethod() == 'POST') {
                $review = new Review();
                $review->setUser($user);
                $form = $this->createForm(new ReviewType(), $review);
                $form->handleRequest($this->getRequest());
                $productRepository = $this->getDoctrine()->getRepository('Sylius\Bundle\CoreBundle\Model\Product');
                $review->setProduct($productRepository->find($review->getProduct()));
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($review);
                    $em->flush();
                }
            }
        }

        return $this->redirect($this->generateUrl('sylius_product_show', array('slug' => $review->getProduct()->getSlug())));
    }
}
