<?php

namespace Tests\Concerns;

trait MakesAssertions
{
    /**
     * Assert that $haystack contains $needle.
     * 
     * @param string $needle string expected to be found in $haystack
     * @param string $haystack
     * @return void
     */
    protected function assertStringContains($needle, $haystack, $message = '')
    {
        $message or $message = "Failed asserting that \"$haystack\" contains \"$needle\".";

        $this->assertTrue(strpos($haystack, $needle) !== false, $message);
    }

    /**
     * Opposite of $this->fail().
     * 
     * This method allows to suppress PHPUnit "risky" warning.
     *
     * @return void
     */
    public function pass()
    {
        $this->assertTrue(true);
    }
}