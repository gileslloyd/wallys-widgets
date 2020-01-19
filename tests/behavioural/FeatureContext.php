<?php

use Behat\Behat\Context\Context;

require_once 'tests/behavioural/context/bootstrap.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
	/**
	 * @Given /^the pack sizes are (\d+), (\d+), (\d+), (\d+) and (\d+)$/
	 */
	public function thePackSizesAreAnd($arg1, $arg2, $arg3, $arg4, $arg5)
	{
		throw new \Behat\Behat\Tester\Exception\PendingException();
	}

	/**
	 * @When /^I order (.*) widgets$/
	 */
	public function iOrderWidgets($ordersize)
	{
		throw new \Behat\Behat\Tester\Exception\PendingException();
	}

	/**
	 * @Then /^I should be allocated (.*) packs$/
	 */
	public function iShouldBeAllocatedPacks($packtotal)
	{
		throw new \Behat\Behat\Tester\Exception\PendingException();
	}
}
