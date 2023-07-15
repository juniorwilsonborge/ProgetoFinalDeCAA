<?php 
require_once 'no.php';
class Queue {
  private $primeiro;
  private $ultimo;

  public function __construct() {
      $this->primeiro = null;
      $this->ultimo = null;
  }

  public function isEmpty() {
      return $this->primeiro === null;
  }

  public function enfileirar($elemento) {
      $novaNO = new Node($elemento);

      if ($this->isEmpty()) {
          $this->primeiro = $novaNO;
          $this->ultimo = $novaNO;
      } else {
          $this->ultimo->next = $novaNO;
          $this->ultimo = $novaNO;
      }
  }

  public function desenfileirar() {
      if ($this->isEmpty()) {
          return null;
      }

      $removedNode = $this->primeiro;
      $this->primeiro = $this->primeiro->next;

      if ($this->primeiro === null) {
          $this->ultimo = null;
      }

      return $removedNode->elemento;
  }
}


class Veiculo {
    private $modelo;
    private $placa;
  
    public function __construct($modelo, $placa) {
      $this->modelo = $modelo;
      $this->placa = $placa;
    }
  
    public function getModelo() {
      return $this->modelo;
    }
  
    public function getPlaca() {
      return $this->placa;
    }
  
    public function __toString() {
      return $this->modelo . " (" . $this->placa . ")";
    }
  }
  

  // Criar uma instância da fila
$estacionamento = new Fila();

// Adicionar veículos à fila
$veiculo1 = new Veiculo("Carro", "st-00-tf");
$veiculo2 = new Veiculo("Moto", "st-01-to");


$estacionamento->enfileirar($veiculo1);
$estacionamento->enfileirar($veiculo2);
$estacionamento->enfileirar($veiculo3);

// Imprimir a fila
$estacionamento->imprimirFila(); 


// Imprimir a fila após remoção
$estacionamento->imprimirFila(); // Saída: Moto (XYZ789) Caminhão (DEF456)

// Acessar os atributos do primeiro veículo da fila
$primeiroVeiculo = $estacionamento->primeiro();
echo "Primeiro veículo: " . $primeiroVeiculo->getModelo() . " (" . $primeiroVeiculo->getPlaca() . ")\n"; // Saída: Primeiro veículo: Moto (XYZ789)


?>