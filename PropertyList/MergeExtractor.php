<?php

namespace FDevs\PropertyInfo\PropertyList;

use Symfony\Component\PropertyInfo\PropertyListExtractorInterface;

class MergeExtractor implements PropertyListExtractorInterface
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
        $properties = [];
        foreach ($this->extractors as $extractor) {
            $extract = $extractor->getProperties($class, $context);
            if (null !== $extract) {
                $properties = array_merge($properties, $extract);
            }
        }

        return empty($properties) ? null : array_values(array_unique($properties));
    }
}
