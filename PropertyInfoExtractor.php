<?php

namespace FDevs\PropertyInfo;

use Symfony\Component\PropertyInfo\PropertyAccessExtractorInterface;
use Symfony\Component\PropertyInfo\PropertyDescriptionExtractorInterface;
use Symfony\Component\PropertyInfo\PropertyInfoExtractorInterface;
use Symfony\Component\PropertyInfo\PropertyListExtractorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;

class PropertyInfoExtractor implements PropertyInfoExtractorInterface
{
    /**
     * @var PropertyListExtractorInterface
     */
    private $propertyList;

    /**
     * @var PropertyTypeExtractorInterface
     */
    private $type;

    /**
     * @var PropertyAccessExtractorInterface;
     */
    private $propertyAccess;

    /**
     * @var PropertyDescriptionExtractorInterface;
     */
    private $propertyDescription;

    /**
     * PropertyInfoExtractor constructor.
     * @param PropertyListExtractorInterface $propertyList
     * @param PropertyTypeExtractorInterface $type
     * @param PropertyAccessExtractorInterface $propertyAccess
     * @param PropertyDescriptionExtractorInterface $propertyDescription
     */
    public function __construct(PropertyListExtractorInterface $propertyList, PropertyTypeExtractorInterface $type, PropertyAccessExtractorInterface $propertyAccess, PropertyDescriptionExtractorInterface $propertyDescription)
    {
        $this->propertyList = $propertyList;
        $this->type = $type;
        $this->propertyAccess = $propertyAccess;
        $this->propertyDescription = $propertyDescription;
    }

    /**
     * {@inheritdoc}
     */
    public function isReadable($class, $property, array $context = array())
    {
        return $this->propertyAccess->isReadable($class, $property, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function isWritable($class, $property, array $context = array())
    {
        return $this->propertyAccess->isWritable($class, $property, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getShortDescription($class, $property, array $context = array())
    {
        return $this->propertyDescription->getShortDescription($class, $property, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getLongDescription($class, $property, array $context = array())
    {
        return $this->propertyDescription->getLongDescription($class, $property, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties($class, array $context = array())
    {
        return $this->propertyList->getProperties($class, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getTypes($class, $property, array $context = array())
    {
        return $this->type->getTypes($class, $property, $context);
    }
}
