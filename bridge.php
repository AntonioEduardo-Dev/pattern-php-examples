<?php
/*


 */
// Interface Transport
interface Transport {
    public function drive(): string;
}

// Classe Motorcycle que implementa Transport
class Motorcycle implements Transport {
    public function drive(): string {
        return "Moto";
    }
}

// Classe Bicycle que implementa Transport
class Bicycle implements Transport {
    public function drive(): string {
        return "Bicicleta";
    }
}

// Classe abstrata TransportMode
abstract class TransportMode {
    protected Transport $driveType;

    public function __construct(Transport $driveType) {
        $this->driveType = $driveType;
    }

    abstract public function move(): string;
}


// Classe Accelerate estende TransportMode
class Accelerate extends TransportMode {
    public function move(): string {
        return "Esta acelerando a " . $this->driveType->drive();
    }
}

// Classe Pedal estende TransportMode
class Pedal extends TransportMode {
    public function move(): string {
        return "Pedalando a " . $this->driveType->drive();
    }
}

$moto = new Accelerate(new Motorcycle());
echo $moto->move() . "\n";

$bike = new Pedal(new Bicycle());
echo $bike->move();
