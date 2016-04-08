<?php

namespace SensioLabs\Deptrac\Collector;

use SensioLabs\AstRunner\AstMap;
use SensioLabs\AstRunner\AstParser\AstClassReferenceInterface;
use SensioLabs\AstRunner\AstParser\AstParserInterface;
use SensioLabs\Deptrac\CollectorFactory;

class MethodNameCollector implements CollectorInterface
{
    public function getType()
    {
        return 'methodName';
    }

    private function getRegexByConfiguration(array $configuration)
    {
        if (!isset($configuration['regex'])) {
            throw new \LogicException('MethodNameCollector needs the regex configuration.');
        }

        return $configuration['regex'];
    }

    public function satisfy(
        array $configuration,
        AstClassReferenceInterface $abstractClassReference,
        AstMap $astMap,
        CollectorFactory $collectorFactory,
        AstParserInterface $astParser
    ) {
        return preg_match(
            '/'.$this->getRegexByConfiguration($configuration).'/i',
            $abstractClassReference->getClassName(),
            $collectorFactory
        );
    }
}