<?php

//Внешняя библиотека:
class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
    {
        return ($diagonal**2)/2;
    }
}
class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
        return (M_PI * $diagonal**2)/4;
}
}

//Имеющиеся интерфейсы:
interface ISquare
{
    function squareArea(int $diagonal);
}
interface ICircle
{
    function circleArea(int $diagonal);
}

class Square implements ISquare
{
    public function squareArea(int $diagonal)
    {
        return "squareArea with diagonal $diagonal";
    }
}

class SquareAdapter extends Square
{
    private $adaptee;

    public function __construct(SquareAreaLib $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function squareArea(int $diagonal)
    {
        return $this->adaptee->getSquareArea($diagonal);
    }
}

class Circle implements ICircle
{
    public function circleArea(int $diagonal)
    {
        return "circleArea with diagonal $diagonal";
    }
}

class CircleAdapter extends Circle
{
    private $adaptee;

    public function __construct(CircleAreaLib $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function circleArea(int $diagonal)
    {
        return $this->adaptee->getCircleArea($diagonal);
    }
}

echo (new Square())->squareArea(50) . '<br>';
echo (new SquareAdapter(new SquareAreaLib()))->squareArea(50) . '<br>';

echo (new Circle())->circleArea(50) . '<br>';
echo (new CircleAdapter(new CircleAreaLib()))->circleArea(50) . '<br>';