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

    public function current() {
        return $this->values[$this->index] ?? 0;
    }

    public function key(): string {
        return sprintf($this->keyMask, $this->index);
    }

    public function next(): void {
        ++$this->index;
    }
    
     public static function fromArray($array,$preserveKeys = true) {
        $self = new self();
        $self->values = \SPLFixedArray::fromArray($array, $preserveKeys);
        return $self;
    }

    public function valid(): bool {
        return $this->index < $this->values->count();
    }
    
    public function offsetExists($offset): bool {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset) {
        return $this->values[$offset];
    }
}

?>
