<?php

interface AbstractFactory
{
    public static function madeBeverageMeal(): BeverageMeal;
    public static function madeDishMeal(): DishMeal;
}

class ChilledMealFactory implements AbstractFactory
{
    public static function madeBeverageMeal(): BeverageMeal
    {
        return new ChilledBeverageMeal();
    }

    public static function madeDishMeal(): DishMeal
    {
        return new ChilledDishMeal();
    }
}

class ReheatedMealFactory implements AbstractFactory
{
    public static function madeBeverageMeal(): BeverageMeal
    {
        return new ReheatedBeverageMeal();
    }

    public static function madeDishMeal(): DishMeal
    {
        return new ReheatedDishMeal();
    }
}

interface Meal
{
    public function make();
}

interface BeverageMeal extends Meal
{

}

interface DishMeal extends Meal
{

}

class ChilledBeverageMeal implements BeverageMeal
{
    public function make(): string
    {
        return 'This is a chilled drink';
    }
}

class ReheatedBeverageMeal implements BeverageMeal
{
    public function make(): string
    {
        return 'This is a reheated drink';
    }
}

class ChilledDishMeal implements DishMeal
{
    public function make(): string
    {
        return 'This is a chilled dish';
    }
}

class ReheatedDishMeal implements DishMeal
{
    public function make(): string
    {
        return 'This is a reheated dish';
    }
}
