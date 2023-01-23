<?php

interface Vehicle
{
    public function made();
}

class Car implements Vehicle
{
    public function made(): string
    {
        return 'I`m a Car';
    }
}

class Motorbike implements Vehicle
{
    public function made(): string
    {
        return 'I`m a Motorbike';
    }
}

interface VehicleFactory
{
    public static function made();
}

class CarFactory implements VehicleFactory
{
    public static function made()
    {
        return new Car();
    }
}

class MotorbikeFactory implements VehicleFactory
{
    public static function made()
    {
        return new Motorbike();
    }
}
