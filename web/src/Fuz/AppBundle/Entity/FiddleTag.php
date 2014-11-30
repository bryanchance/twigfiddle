<?php

namespace Fuz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiddleTag
 *
 * @ORM\Table(name="fiddle_tag")
 * @ORM\Entity
 */
class FiddleTag
{

    /**
     * @var Fiddle
     *
     * @ORM\OneToOne(targetEntity="Fiddle")
     * @ORM\JoinColumn(name="fiddle_id", referencedColumnName="id", onDelete="cascade")
     * @ORM\Id
     */
    protected $fiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=32, nullable=true)
     */
    protected $tag;

    /**
     * Set fiddle
     *
     * @param Fiddle $fiddle
     * @return FiddleTag
     */
    public function setFiddle(Fiddle $fiddle)
    {
        $this->fiddle = $fiddle;

        return $this;
    }

    /**
     * Get fiddle
     *
     * @return Fiddle|null
     */
    public function getFiddle()
    {
        return $this->fiddle;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return FiddleTag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

}