<?php

declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/shot/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/MockingMagician/shot/blob/master/README.md
 */

namespace MockingMagician\Shot;

use MockingMagician\Shot\Exceptions\ProtectedException;

final class ServiceCompiler
{
    private $serviceDefinition;
    private $serviceRegister;
    private $bindIterator;
    /** @var string */
    private $compiled = null;

    public function __construct(
        ServiceDefinition $serviceDefinition,
        ServiceRegister $serviceRegister,
        BindIterator $bindIterator
    ) {
        $this->serviceDefinition = $serviceDefinition;
        $this->serviceRegister = $serviceRegister;
        $this->bindIterator = $bindIterator;
    }

    /**
     * @throws \ReflectionException
     * @throws ProtectedException
     */
    public function compile(): string
    {
        if (is_string($this->compiled)) {
            return $this->compiled;
        }

        $this->compiled = "<?php\n\nreturn function (MockingMagician\Shot\ServiceRegister \$serviceRegister) {\n\n    ";

        $this->serviceDefinition->isSingleton();
        $callIterator = $this->serviceDefinition->getCalls();
        $class = new \ReflectionClass($this->serviceDefinition->getClass());
        if (0 === \count($callIterator)) {
            $callIterator->append(new CallIterator(new Call('__construct')));
        }
        $var = null;
        foreach ($callIterator as $call) {
            $var = $this->writeCall($class, $call, $var);
        }

        $this->compiled .= "return \$service;\n}\n";

        return $this->compiled;
    }

    private function write(string $string): void
    {
        $this->compiled .= $string;
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @param Call             $call
     * @param null|string      $lastVarName
     *
     * @throws ProtectedException
     *
     * @return null|string
     */
    private function writeCall(
        \ReflectionClass $reflectionClass,
        Call $call,
        string $lastVarName = null
    ) {
        if (null === $lastVarName) {
            $varName = 'service';
        }
        $method = $call->getMethod();
        $reflectionMethod = $reflectionClass->getMethod($method);
        $modifiers = \Reflection::getModifierNames($reflectionMethod->getModifiers());
        if (!empty(\array_intersect(['protected', 'private'], $modifiers))) {
            throw new ProtectedException($reflectionClass->getName(), $method);
        }
        if (\in_array('static', $modifiers, true)) {
            $this->write('$'.$varName.' = '.$reflectionClass->getName().'::'.$method.'(');
        } elseif ('__construct' === $method) {
            $this->write('$'.$varName.' = new '.$reflectionClass->getName().'(');
        } elseif (null !== $lastVarName) {
            $this->write('$'.$varName.' = $'.$lastVarName.'->'.$method.'(');
        } else {
            // TODO create and add better Exception
            throw new \LogicException('Case not defined');
        }
        $parameterStack = [];
        foreach ($reflectionMethod->getParameters() as $k => $parameter) {
            if (isset($call->getArguments()[$k])) {
                $parameterStack[] = $call->getArguments()[$k];
                continue;
            }
            $parameterName = $parameter->getName();
            $boundParameter = $this->getBoundParameter($parameterName);
            if (null !== $boundParameter) {
                $parameterStack[] = $boundParameter;

                continue;
            }
        }
        $this->write(implode(', ', $parameterStack) . ");\n\n    ");

        return $varName;
    }

    private function getBoundParameter(string $parameterName)
    {
        foreach ($this->bindIterator as $bind) {
            if ($parameterName === $bind->getName()) {
                if (0 === \mb_strpos($bind->getValue(), '@')) {
                    return '$serviceRegister->('.$bind->getValue().')';
                }
                if (\is_string($bind->getValue())) {
                    return "'".\str_replace("'", "\\'", $bind->getValue())."'";
                }

                return $bind->getValue();
            }
        }

        return null;
    }
}
