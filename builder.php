<?php
/*

O Builder Pattern é útil quando você tem um objeto complexo com várias partes ou etapas de construção. No caso de um sistema de listagem de descontos, você pode ter uma classe Desconto que precisa ser configurada com diferentes tipos de descontos e condições.

 */
class Desconto {
    private $percentual;
    private $categoriaProduto;
    private $quantidadeMinima;
    private $dataInicio;
    private $dataFim;

    // Getters e setters para cada atributo
    public function getPercentual() {
        return $this->percentual;
    }

    public function setPercentual($percentual) {
        $this->percentual = $percentual;
    }

    public function getCategoriaProduto() {
        return $this->categoriaProduto;
    }

    public function setCategoriaProduto($categoriaProduto) {
        $this->categoriaProduto = $categoriaProduto;
    }

    public function getQuantidadeMinima() {
        return $this->quantidadeMinima;
    }

    public function setQuantidadeMinima($quantidadeMinima) {
        $this->quantidadeMinima = $quantidadeMinima;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }
}

interface DescontoBuilder {
    public function setPercentual($percentual);
    public function setCategoriaProduto($categoriaProduto);
    public function setQuantidadeMinima($quantidadeMinima);
    public function setDataInicio($dataInicio);
    public function setDataFim($dataFim);
    public function build();
}

class DescontoConcretoBuilder implements DescontoBuilder {
    private $desconto;

    public function __construct() {
        $this->desconto = new Desconto();
    }

    public function setPercentual($percentual) {
        $this->desconto->setPercentual($percentual);
        return $this;
    }

    public function setCategoriaProduto($categoriaProduto) {
        $this->desconto->setCategoriaProduto($categoriaProduto);
        return $this;
    }

    public function setQuantidadeMinima($quantidadeMinima) {
        $this->desconto->setQuantidadeMinima($quantidadeMinima);
        return $this;
    }

    public function setDataInicio($dataInicio) {
        $this->desconto->setDataInicio($dataInicio);
        return $this;
    }

    public function setDataFim($dataFim) {
        $this->desconto->setDataFim($dataFim);
        return $this;
    }

    public function build() {
        return $this->desconto;
    }
}

// Criação de um desconto com o Builder Pattern
$builder = new DescontoConcretoBuilder();
$desconto = $builder->setPercentual(10)
                    ->setCategoriaProduto("Eletrônicos")
                    ->setQuantidadeMinima(3)
                    ->setDataInicio("2024-08-01")
                    ->setDataFim("2024-08-31")
                    ->build();

// Exemplo de uso do desconto
echo "Desconto: " . $desconto->getPercentual() . "% para a categoria " . $desconto->getCategoriaProduto();
