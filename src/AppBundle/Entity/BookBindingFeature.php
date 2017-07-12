<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookBindingFeature
 *
 * @ORM\Table(name="book_binding_feature", indexes={@ORM\Index(name="fk_book_binding_feature_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class BookBindingFeature
{
    /**
     * @var integer
     *
     * @ORM\Column(name="binding_feature_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bindingFeatureId;

    /**
     * @var integer
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bookId;


}

