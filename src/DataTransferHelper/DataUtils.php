<?php declare(strict_types=1);

namespace App\DataTransferHelper;

use Error;
use Exception;

class DataUtils
{
    private $source;
    private $target;
    private $filteredSourceMethods = [];
    private $filteredTargetMethods = [];

    /**
     * @param $source
     * @param $target
     * @throws Error
     * @throws Exception
     */
    public function copyProperties($source, $target)
    {
        $this->setSource($source);
        $this->setTarget($target);

        $sourceMethods = get_class_methods($source);
        $targetMethods = get_class_methods($target);

        $this->filterMethods($sourceMethods, $targetMethods);

        $this->copyValuesFromProperties();
    }

    /**
     * @param $sourceMethods
     * @param $targetMethods
     */
    private function filterMethods($sourceMethods, $targetMethods)
    {
        foreach ($sourceMethods as $sourceMethod) {
            foreach ($targetMethods as $targetMethod) {
                $this->addEqualMethodsToLists($sourceMethod, $targetMethod);
            }
        }
    }

    /**
     * @param $sourceMethod
     * @param $targetMethod
     */
    private function addEqualMethodsToLists($sourceMethod, $targetMethod) {
        $sourceMethodGetterName = preg_replace('/^(get)/', "", $sourceMethod);
        $targetMethodSetterName = preg_replace('/^(set)/', "", $targetMethod);

        if ($sourceMethodGetterName === $targetMethodSetterName) {
            $this->addSourceMethod($sourceMethod);
            $this->addTargetMethod($targetMethod);
        }
    }

    private function copyValuesFromProperties()
    {
        foreach ($this->filteredSourceMethods as $sourceMethod) {
            if (preg_match('/^(get)/', $sourceMethod)) {
                $this->findSetter($sourceMethod);
            }
        }
    }

    private function findSetter($sourceMethod)
    {
        foreach ($this->filteredTargetMethods as $targetMethod) {
            if (preg_match('/^(set)/', $targetMethod)) {
                $sourceMethodGetterName = preg_replace('/^(get)/', "", $sourceMethod);
                $targetMethodSetterName = preg_replace('/^(set)/', "", $targetMethod);
                if ($sourceMethodGetterName === $targetMethodSetterName) {
                    $sourceClassName = $this->getSource();
                    $targetClassName = $this->getTarget();
                    $targetClassName->$targetMethod($sourceClassName->$sourceMethod());
                }
            }
        }
    }

    private function setSource($source)
    {
        $this->source = $source;
    }

    private function getSource()
    {
        return $this->source;
    }

    private function setTarget($target)
    {
        $this->target = $target;
    }

    private function getTarget()
    {
        return $this->target;
    }

    private function addSourceMethod($method)
    {
        array_push($this->filteredSourceMethods, $method);
    }

    private function addTargetMethod($method)
    {
        array_push($this->filteredTargetMethods, $method);
    }

}
