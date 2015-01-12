<?php namespace JakubRiedl\Dbqb;

use JakubRiedl\Dbqb\Query\Grammars\SQLiteGrammar as QueryGrammar;

class SQLiteConnection extends Connection
{

    /**
     * Get the default query grammar instance.
     *
     * @return \JakubRiedl\Dbqb\Query\Grammars\SQLiteGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \JakubRiedl\Dbqb\Query\Processors\Processor
     */
    protected function getDefaultPostProcessor()
    {
        return new Query\Processors\SQLiteProcessor;
    }
}
