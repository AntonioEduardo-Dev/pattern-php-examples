<?php
/*

Situação: Sistema de Descontos Personalizados para Clientes
Suponha que você tem um sistema de e-commerce onde oferece diferentes tipos de descontos personalizados para clientes baseados em seu histórico de compras, categorias de produtos preferidos, etc. Cada desconto pode ter regras específicas e parâmetros personalizados.

Exemplo de Cenário
Desconto de Aniversário: Oferece 10% de desconto no mês de aniversário do cliente.
Desconto de Primeira Compra: Oferece 15% de desconto na primeira compra do cliente.
Desconto VIP: Oferece 20% de desconto para clientes VIP.

 */
interface DiscountPrototype
{
    public function __clone();
}

class BirthdayDiscount implements DiscountPrototype
{
    public $percentage;
    public $validityPeriod;

    public function __construct($percentage, $validityPeriod)
    {
        $this->percentage = $percentage;
        $this->validityPeriod = $validityPeriod;
    }

    public function __clone()
    {
    }
}

class FirstPurchaseDiscount implements DiscountPrototype
{
    public $percentage;
    public $minimumPurchase;

    public function __construct($percentage, $minimumPurchase)
    {
        $this->percentage = $percentage;
        $this->minimumPurchase = $minimumPurchase;
    }

    public function __clone()
    {
    }
}

class VIPDiscount implements DiscountPrototype
{
    public $percentage;
    public $vipLevel;

    public function __construct($percentage, $vipLevel)
    {
        $this->percentage = $percentage;
        $this->vipLevel = $vipLevel;
    }

    public function __clone()
    {
    }
}

// Criação dos protótipos
$birthdayDiscountPrototype = new BirthdayDiscount(10, '1 month');
$firstPurchaseDiscountPrototype = new FirstPurchaseDiscount(15, 50);
$vipDiscountPrototype = new VIPDiscount(20, 'Gold');

// Clonagem dos descontos personalizados
$newBirthdayDiscount = clone $birthdayDiscountPrototype;
$newFirstPurchaseDiscount = clone $firstPurchaseDiscountPrototype;
$newVIPDiscount = clone $vipDiscountPrototype;

// Ajustar detalhes dos novos descontos clonados se necessário
$newBirthdayDiscount->validityPeriod = '2 weeks'; // Exemplo de ajuste
$newVIPDiscount->vipLevel = 'Platinum';

var_dump($newBirthdayDiscount);
var_dump($newFirstPurchaseDiscount);
var_dump($newVIPDiscount);