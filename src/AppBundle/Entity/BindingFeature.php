<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BindingFeature
 *
 * @ORM\Table(name="binding_feature")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BindingFeatureRepository")
 */
class BindingFeature
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

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

    public function __toString() {
        return $this->bindingFeature;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set bindingFeature
     *
     * @param string $bindingFeature
     *
     * @return BindingFeature
     */
    public function setBindingFeature($bindingFeature) {
        $this->bindingFeature = $bindingFeature;

        return $this;
    }

    /**
     * Get bindingFeature
     *
     * @return string
     */
    public function getBindingFeature() {
        return $this->bindingFeature;
    }

    /**
     * Set bindingFeatureNotes
     *
     * @param string $bindingFeatureNotes
     *
     * @return BindingFeature
     */
    public function setBindingFeatureNotes($bindingFeatureNotes) {
        $this->bindingFeatureNotes = $bindingFeatureNotes;

        return $this;
    }

    /**
     * Get bindingFeatureNotes
     *
     * @return string
     */
    public function getBindingFeatureNotes() {
        return $this->bindingFeatureNotes;
    }
}
