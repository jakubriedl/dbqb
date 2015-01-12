<?php namespace JakubRiedl\Dbqb;

use JakubRiedl\Dbqb\Query\Processors\PostgresProcessor;
use JakubRiedl\Dbqb\Query\Grammars\PostgresGrammar as QueryGrammar;

class PostgresConnection extends Connection {

	/**
	 * Get the default query grammar instance.
	 *
	 * @return \JakubRiedl\Dbqb\Query\Grammars\PostgresGrammar
	 */
	protected function getDefaultQueryGrammar()
	{
		return $this->withTablePrefix(new QueryGrammar);
	}

	/**
	 * Get the default post processor instance.
	 *
	 * @return \JakubRiedl\Dbqb\Query\Processors\PostgresProcessor
	 */
	protected function getDefaultPostProcessor()
	{
		return new PostgresProcessor;
	}
}
