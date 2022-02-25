<?php

declare(strict_types=1);

namespace WebmozartAssertBug32;

use Webmozart\Assert\Assert;

class Bug32
{

	public function foo(string $a, int $b, float $c)
	{
		Assert::integerish($a);
		Assert::integerish($b);
		Assert::integerish($c);
		Assert::integerish(1.000);
		Assert::integerish(1.001);
	}

}
