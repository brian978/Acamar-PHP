<?php
/**
 * Acamar-Framework
 *
 * @link      https://github.com/brian978/Acamar-Framework
 * @copyright Copyright (c) 2013
 * @license   Creative Commons Attribution-ShareAlike 3.0
 */

namespace Acamar\Model\Entity;

use Acamar\Collection\CollectionInterface;

interface EntityCollectionInterface extends CollectionInterface
{
    /**
     * @param EntityInterface $entity
     * @return $this
     */
    public function add(EntityInterface $entity);
}