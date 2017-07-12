<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BindingFeature
 *
 * @ORM\Table(name="binding_feature")
 * @ORM\Entity
 */
class BindingFeature
{
    /**
     * @var integer
     *
     * @ORM\Column(name="binding_feature_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bindingFeatureId;

    /**
     * @var string
     *
     * @ORM\Column(name="binding_feature", type="string", length=255, nullable=true)
     */
    private $bindingFeature;

    /**
     * @var string
     *
     * @ORM\Column(name="binding_feature_notes", type="text", length=16777215, nullable=true)
     */
    private $bindingFeatureNotes;


}

