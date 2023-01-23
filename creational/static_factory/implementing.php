<?php

interface Food
{
    public function made();
}

class Pizza implements Food
{
    public function made(): string
    {
        return 'I`m a Pizza!';
    }
}

class Sushi implements Food
{
    public function made(): string
    {
        return 'I`m a Sushi!';
    }
}

class FoodFactory
{
    public static function make($foodTitle): Food|Exception
    {
        $ClassName = ucfirst($foodTitle);
        if (class_exists($ClassName)) {
            return new $ClassName();
        }
        return throw new Exception("Error making Food", 1,);
    }
}
