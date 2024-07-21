<?php
/*

Você tem diferentes tipos de descontos em seu sistema, como descontos percentuais, descontos fixos e descontos sazonais. Cada tipo de desconto possui sua própria lógica de cálculo e propriedades específicas. Para gerenciar isso de forma eficiente e escalável, você pode usar o Factory Pattern para criar instâncias dos diferentes tipos de desconto.

 */

interface Discount {
    public function calculate(float $originalPrice): float;
}

class PercentageDiscount implements Discount {
    private $percentage;
    
    public function __construct(float $percentage) {
        $this->percentage = $percentage;
    }

    public function calculate(float $originalPrice): float {
        return $originalPrice * (1 - $this->percentage / 100);
    }
}

class FixedDiscount implements Discount {
    private $amount;

    public function __construct(float $amount) {
        $this->amount = $amount;
    }

    public function calculate(float $originalPrice): float {
        return $originalPrice - $this->amount;
    }
}

abstract class DiscountFactory
{
    abstract public function createDiscountFactory(float $percentage): Discount;

    public function createDiscount(float $originalPrice, float $percentage): float
    {
        $product = $this->createDiscountFactory($percentage);
        return $product->calculate($originalPrice);
    }
}

class ConcretePercentageFactory extends DiscountFactory
{
    public function createDiscountFactory(float $percentage): Discount
    {
        return new PercentageDiscount($percentage);
    }
}

class ConcreteFixedFactory extends DiscountFactory
{
    public function createDiscountFactory(float $percentage): Discount
    {
        return new FixedDiscount($percentage);
    }
}

function clientCode(DiscountFactory $creator, $originalPrice, $percentage)
{
    // ...
    echo $creator->createDiscount($originalPrice, $percentage);
}

// echo "App: Launched with the ConcreteCreator1.\n";
clientCode(new ConcretePercentageFactory(), 100, 10);
echo "\n\n";

// echo "App: Launched with the ConcreteCreator2.\n";
clientCode(new ConcreteFixedFactory(),  50, 10);