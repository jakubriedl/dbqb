<?php namespace JakubRiedl\Dbqb\Query\Processors;

use JakubRiedl\Dbqb\Query\Builder;

class PostgresProcessor extends Processor {

	/**
	 * Process an "insert get ID" query.
	 *
	 * @param  \JakubRiedl\Dbqb\Query\Builder  $query
	 * @param  string  $sql
	 * @param  array   $values
	 * @param  string  $sequence
	 * @return int
	 */
	public function processInsertGetId(Builder $query, $sql, $values, $sequence = null)
	{
		$results = $query->getConnection()->selectFromWriteConnection($sql, $values);

		$sequence = $sequence ?: 'id';

		$result = (array) $results[0];

		$id = $result[$sequence];

		return is_numeric($id) ? (int) $id : $id;
	}

	/**
	 * Process the results of a column listing query.
	 *
	 * @param  array  $results
	 * @return array
	 */
	public function processColumnListing($results)
	{
		return array_values(array_map(function($r) { $r = (object) $r; return $r->column_name; }, $results));
	}

}
