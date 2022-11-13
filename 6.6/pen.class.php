<?php

class Pen {

    public $ink_color;

    public function __construct($ink_color) {
        $this->ink_color = $ink_color;
    }

    public function write($message) {
        echo $message;
    }
}

class PenWithCap  extends Pen {
    public function toggleCap() {
    }
}

class RetractablePen extends Pen {
    public function togglePoint() {

    }

    public function write($message) {
        return 'written with retractable pen:' . $message;
    }
}

$cappedPen = new PenWithCap('Black');
$cappedPen->toggleCap();
$cappedPen->write("Hello world!");
$cappedPen->toggleCap();

$cappedPen = new RetractablePen('Blue');
$cappedPen->togglePoint();
$cappedPen->write("Hello world!");
$cappedPen->togglePoint();