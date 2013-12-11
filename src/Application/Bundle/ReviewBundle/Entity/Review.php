<?php

namespace Application\Bundle\ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Bundle\CoreBundle\Model\Product;
use Sylius\Bundle\CoreBundle\Model\User;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Review
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;
    /**
     * @ORM\ManyToOne(targetEntity="Sylius\Bundle\CoreBundle\Model\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", unique=false)
     *
     * @var Product
     */
    private $product;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Sylius\Bundle\CoreBundle\Model\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Review
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
