<?php declare(strict_types = 1);

namespace PHPStan\Type\WebMozartAssert;

use Webmozart\Assert\Assert;

class Foo
{

	public function isList($a): void
	{
		Assert::isList($a);
		\PHPStan\Testing\assertType('array<int, mixed>', $a);
	}

}
