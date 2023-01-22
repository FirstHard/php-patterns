<?php

class Worker
{
    private ?string $name;

    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name): void
    {
        $this->name = $name;
    }
}

class WorkerFactory
{
    public static function make(): Worker
    {
        return new Worker();
    }
}
