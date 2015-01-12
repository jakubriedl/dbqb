<?php namespace JakubRiedl\Dbqb\Query\Processors;

class MySqlProcessor extends Processor {

	/**
	 * Process the results of a column listing query.
	 *
	 * @param  array  $results
	 * @return array
	 */
	public function processColumnListing($results)
	{
		return array_map(function($r) { $r = (object) $r; return $r->column_name; }, $results);
	}

}
