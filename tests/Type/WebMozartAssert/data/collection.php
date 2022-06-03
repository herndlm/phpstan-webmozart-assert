<?php declare(strict_types = 1);

namespace PHPStan\Type\WebMozartAssert;

use stdClass;
use Webmozart\Assert\Assert;
use function PHPStan\Testing\assertType;

class CollectionTest
{

	public function allString(array $a, $b): void
	{
		Assert::allString($a);
		assertType('array<string>', $a);

		Assert::allString($b);
		assertType('iterable<string>', $b);
	}

	public function allStringNotEmpty(array $a, iterable $b, $c): void
	{
		Assert::allStringNotEmpty($a);
		assertType('array<non-empty-string>', $a);

		Assert::allStringNotEmpty($b);
		assertType('iterable<non-empty-string>', $b);

		Assert::allStringNotEmpty($c);
		assertType('iterable<non-empty-string>', $c);
	}

	public function allInteger(array $a, iterable $b, $c): void
	{
		Assert::allInteger($a);
		assertType('array<int>', $a);

		Assert::allInteger($b);
		assertType('iterable<int>', $b);

		Assert::allInteger($c);
		assertType('iterable<int>', $c);
	}

	public function allInstanceOf(array $a, array $b, array $c, $d): void
	{
		Assert::allIsInstanceOf($a, stdClass::class);
		assertType('array<stdClass>', $a);

		Assert::allIsInstanceOf($b, new stdClass());
		assertType('array<stdClass>', $b);

		Assert::allIsInstanceOf($c, 17);
		assertType('array', $c);

		Assert::allIsInstanceOf($d, new stdClass());
		assertType('iterable<stdClass>', $d);
	}

	/**
	 * @param (CollectionFoo|CollectionBar)[] $a
	 * @param (CollectionFoo|stdClass)[] $b
	 * @param CollectionFoo[] $c
	 */
	public function allNotInstanceOf(array $a, array $b, array $c): void
	{
		Assert::allNotInstanceOf($a, CollectionBar::class);
		assertType('array<PHPStan\Type\WebMozartAssert\CollectionFoo>', $a);

		Assert::allNotInstanceOf($b, new stdClass());
		assertType('array<PHPStan\Type\WebMozartAssert\CollectionFoo>', $b);

		Assert::allNotInstanceOf($c, 17);
		assertType('array<PHPStan\Type\WebMozartAssert\CollectionFoo>', $c);
	}

	/**
	 * @param (int|null)[] $a
	 */
	public function allNotNull(array $a): void
	{
		Assert::allNotNull($a);
		assertType('array<int>', $a);
	}

	/**
	 * @param array{-1|1, -2|2, -3|3} $a
	 */
	public function allNotSame(array $a): void
	{
		Assert::allNotSame($a, -1);
		assertType('array{1, -2|2, -3|3}', $a);
	}

	public function allSubclassOf(array $a, iterable $b, $c): void
	{
		Assert::allSubclassOf($a, self::class);
		assertType('array<class-string<PHPStan\Type\WebMozartAssert\CollectionTest>|PHPStan\Type\WebMozartAssert\CollectionTest>', $a);

		Assert::allSubclassOf($b, self::class);
		assertType('iterable<class-string<PHPStan\Type\WebMozartAssert\CollectionTest>|PHPStan\Type\WebMozartAssert\CollectionTest>', $b);

		Assert::allSubclassOf($c, self::class);
		assertType('iterable<class-string<PHPStan\Type\WebMozartAssert\CollectionTest>|PHPStan\Type\WebMozartAssert\CollectionTest>', $c);
	}

	/**
	 * @param array<array{id?: int}> $a
	 * @param array<int, array<string, mixed>> $b
	 *
	 */
	public function allKeyExists(array $a, array $b, array $c, $d): void
	{
		Assert::allKeyExists($a, 'id');
		assertType('array<array{id: int}>', $a);

		Assert::allKeyExists($b, 'id');
		assertType('array<int, array<string, mixed>&hasOffset(\'id\')>', $b);

		Assert::allKeyExists($c, 'id');
		assertType('array<array&hasOffset(\'id\')>', $c);
	}

	/**
	 * @param array<array> $a
	 */
	public function allCount(array $a): void
	{
		Assert::allCount($a, 2);
		assertType('array<non-empty-array>', $a);
	}

	public function allNullOr(array $a, iterable $b, $c): void
	{
		Assert::allNullOrStringNotEmpty($a);
		assertType('array<non-empty-string|null>', $a);

		Assert::allNullOrIsInstanceOf($b, stdClass::class);
		assertType('iterable<stdClass|null>', $b);

		Assert::allNullOrScalar($c);
		assertType('iterable<bool|float|int|string|null>', $c);
	}

}

class CollectionFoo
{

}

interface CollectionBar
{

}
