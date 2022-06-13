
<?php

    $number = 600851475143;

    class PrimeFactors {
        protected $number;
        protected $stack;

        public function __construct($number)
        {
            $this->number = $number;
            $this->stack = new SplStack();
        }

        public function getMaxPF()
        {
            for ($i = 2; $i <= sqrt($this->number); $i++) {
                while ($this->number % $i == 0) {
                    $this->stack->push($i);
                    $this->number /= $i;
                }
            }

            if ($this->number != 1) {
                $this->stack->push($this->number);
            }

            return $this->stack->pop();
        }
    }

    $task4 = new PrimeFactors($number);

    echo $task4->getMaxPF();

//6857

