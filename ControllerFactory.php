<?php

class ControllerFactory {
    private ReflectionClass $reflector;

    private function resolveDependencies(ReflectionClass $reflector) {
        $properties = $reflector->getConstructor()->getParameters();
        $params = [];

        if (count($properties) > 0) {
            foreach ($properties as $prop) {  
                $className = $prop->getClass()->getName();

                if ($className == "Database") {
                    $classInstance = new Database();
                    if (!$classInstance->connect())
                        throw new Exception("database connection error");
                } else
                    $classInstance = $this->resolveDependencies(new ReflectionClass($className));

                array_push($params, $classInstance);
            }
        }

        return $reflector->newInstanceArgs($params);
    }

    public function __construct(string $controllerName) {
        $this->reflector = new ReflectionClass($controllerName);
    }
 
    public function create() {
        return $this->resolveDependencies($this->reflector);
    }
}