<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DigitalCopyHolder
 *
 * @ORM\Table(name="digital_copy_holder")
 * @ORM\Entity
 */
class DigitalCopyHolder
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="digital_copy_holder_id", type="integer", nullable=false)
     * @ORM\GeneratedValue()
     */
    private $digitalCopyHolderId;

    /**
     * @var string
     *
     * @ORM\Column(name="organization_name", type="string", length=255, nullable=true)
     */
    private $organizationName;


}

