<?php

namespace FDevs\PropertyInfo\PropertyList;

use Symfony\Component\PropertyInfo\PropertyListExtractorInterface;

class PriorityExtractor implements PropertyListExtractorInterface
{
    /**
     * @var iterable|PropertyListExtractorInterface[]
     */
    private $extractors = [];

    /**
     * PriorityExtractor constructor.
     * @param iterable|PropertyListExtractorInterface[] $extractors
     */
    public function __construct(iterable $extractors)
    {
        $this->extractors = $extractors;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties($class, array $context = array())
    {
        $properties = null;
        foreach ($this->extractors as $extractor) {
            $properties = $extractor->getProperties($class, $context);
            if (null !== $properties) {
                break;
            }
        }

        return $properties;
    }
}
