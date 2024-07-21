<?php
/*

Você tem um sistema de e-commerce onde múltiplos módulos e classes precisam acessar as regras de desconto para calcular os preços finais dos produtos. Essas regras de desconto podem ser complexas e depender de diversos fatores, como promoções ativas, categorias de produtos, ou perfis de clientes. Para evitar a criação de múltiplas instâncias dessa lógica de desconto e garantir a consistência dos cálculos, você pode usar o Singleton Pattern.

 */
class DiscountManager
{
    // A instância única da classe
    private static $instance = null;
    
    // Regras de desconto armazenadas na classe
    private $discountRules;

    // Construtor privado para evitar instanciação externa
    private function __construct()
    {
        $this->discountRules = $this->loadDiscountRules();
    }

    // Método para obter a instância única
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DiscountManager();
        }

        return self::$instance;
    }

    // Método para carregar as regras de desconto
    private function loadDiscountRules()
    {
        // Carregar as regras de desconto de um banco de dados ou outro local
        return [
            'default' => 0.05, // 5% de desconto padrão
            'category_electronics' => 0.10, // 10% de desconto para eletrônicos
            'vip_customer' => 0.15 // 15% de desconto para clientes VIP
        ];
    }

    // Método para calcular o desconto com base nas regras
    public function calculateDiscount($productCategory, $customerType)
    {
        $discount = $this->discountRules['default'];
        
        if (isset($this->discountRules['category_' . $productCategory])) {
            $discount += $this->discountRules['category_' . $productCategory];
        }

        if (isset($this->discountRules[$customerType])) {
            $discount += $this->discountRules[$customerType];
        }

        return $discount;
    }
}

// Exemplo de uso do Singleton
$discountManager = DiscountManager::getInstance();
$discount = $discountManager->calculateDiscount('electronics', 'vip_customer');
echo 'Desconto aplicado: ' . ($discount * 100) . '%'; // Saída: Desconto aplicado: 30%

?>
