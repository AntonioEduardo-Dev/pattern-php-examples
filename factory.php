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

// $percentageDiscount = new PercentageDiscount(100);
// echo $percentageDiscount->calculate();

class DiscountFactory {
    public static function createDiscount(string $type, float $value): Discount {
        switch ($type) {
            case 'percentage':
                return new PercentageDiscount($value);
            case 'fixed':
                return new FixedDiscount($value);
            default:
                throw new InvalidArgumentException("Tipo de desconto desconhecido");
        }
    }
}

// Exemplo de uso
$discountType = 'percentage'; // ou 'fixed', 'seasonal'
$discountValue = 10; // Porcentagem ou valor fixo

$discount = DiscountFactory::createDiscount($discountType, $discountValue);

$originalPrice = 100.00;
$finalPrice = $discount->calculate($originalPrice);

echo "Preço final após desconto: $finalPrice";
