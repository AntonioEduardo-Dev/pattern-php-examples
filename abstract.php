<?php
/*

Situação: Sistema de Descontos para Diferentes Tipos de Usuários
Imagine que você tenha um sistema que precisa aplicar descontos diferentes para diferentes tipos de usuários (como clientes regulares, clientes VIP, e clientes corporativos). Cada tipo de usuário pode ter uma lógica diferente para calcular o desconto.

 */
interface Discount {
    public function calculate(float $amount): float;
}

class ConcreteUserCustomerDiscount implements Discount {
    public function calculate(float $amount): float {
        return $amount * 0.90; // 10% de desconto
    }
}

class ConcreteVipCustomerDiscount implements Discount {
    public function calculate(float $amount): float {
        return $amount * 0.50; // 50% de desconto
    }
}

interface DiscountFactory {
    public function createDiscount(): Discount;
}

class ConcreteUserCustomerDiscountFactory implements DiscountFactory {
    public function createDiscount(): Discount {
        return new ConcreteUserCustomerDiscount;
    }
}

class ConcreteVipCustomerDiscountFactory implements DiscountFactory {
    public function createDiscount(): Discount {
        return new ConcreteVipCustomerDiscount;
    }
}

class DiscountService {
    private DiscountFactory $discountFactory;

    public function __construct(DiscountFactory $discountFactory) {
        $this->discountFactory = $discountFactory;
    }

    public function applyDiscount(float $amount): float {
        $discount = $this->discountFactory->createDiscount();
        return $discount->calculate($amount);
    }
}

// Para um cliente regular
$regularFactory = new ConcreteUserCustomerDiscountFactory;
$discountService = new DiscountService($regularFactory);
$discountedAmount = $discountService->applyDiscount(100.0);
echo "Preço com desconto: $discountedAmount ";

// Para um cliente VIP
$vipFactory = new ConcreteVipCustomerDiscountFactory();
$discountService = new DiscountService($vipFactory);
$discountedAmount = $discountService->applyDiscount(100.0);
echo "Preço com desconto: $discountedAmount ";