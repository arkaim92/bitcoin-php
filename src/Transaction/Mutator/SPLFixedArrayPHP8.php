<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Transaction\Mutator;

class SPLFixedArrayPHP8 implements \Iterator {
    private $keyMask;
    private $values;
    private $index;

    public function __construct(int $digits = 1) {
        $this->values = new \SPLFixedArray($digits);
        $this->keyMask = "%0{$digits}s";
        $this->index = 0;
    }

    public function rewind(): void {
        $this->index = 0;
    }

    public function current(): int {
        return $this->values[$this->index] ?? 0;
    }

    public function key(): string {
        return sprintf($this->keyMask, $this->index);
    }

    public function next(): void {
        ++$this->index;
    }
    
    public static function fromArray($array,$preserveKeys = true) {
        $this->values = \SPLFixedArray::fromArray($array, $preserveKeys);
    }

    public function valid(): bool {
        return $this->index < $this->values->count();
    }
}

?>
