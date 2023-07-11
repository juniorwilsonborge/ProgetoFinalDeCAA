<?php 
class Fila {
  private $fila;

  public function __construct() {
    $this->fila = array();
  }

  public function enfileirar($veiculo) {
    $this->fila[] = $veiculo;
  }

  public function desenfileirar() {
    if ($this->estaVazia()) {
      return null;
    }

    return array_shift($this->fila);
  }

  public function estaVazia() {
    return empty($this->fila);
  }

  public function tamanho() {
    return count($this->fila);
  }

  public function primeiro() {
    return $this->fila[0];
  }

  //emprime fila
  public function imprimirFila() {
    foreach ($this->fila as $veiculo) {
      echo $veiculo . " ";
    }
    echo "\n";
  }
}



//clas veiculo

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
$veiculo3 = new Veiculo("Caminhão", "st-91-ux");

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