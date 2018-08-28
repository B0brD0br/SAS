<?php

namespace SAS\Tests\DataTransformation;

use SAS\DataTransformation\TimeNormalization;
use PHPUnit\Framework\TestCase;

class TimeNormalizationTest extends TestCase
{
    public function testIfReturningAnInstanceOfDateTimeObj()
    {
        $denormalizer = new TimeNormalization;
        $time = '2018-04-25 12:13:14';
        $time = $denormalizer->denormalizeTime($time);

        $this->assertInstanceOf(\DateTime::class, $time);
    }
}
