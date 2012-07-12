<?php namespace Illuminate\Database\Eloquent\Relations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class Relation {

	/**
	 * The Eloquent query builder instance.
	 *
	 * @var Illuminate\Database\Eloquent\Builder
	 */
	protected $query;

	/**
	 * The parent model instance.
	 *
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $parent;

	/**
	 * The related model instance.
	 *
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $related;

	/**
	 * Create a new relation instance.
	 *
	 * @param  Illuminate\Database\Eloquent\Builder
	 * @param  Illuminate\Database\Eloquent\Model
	 * @return void
	 */
	public function __construct(Builder $query, Model $parent)
	{
		$this->query = $query;
		$this->parent = $parent;
		$this->related = $query->getModel();

		$this->addConstraints();
	}

	/**
	 * Set the base constraints on the relation query.
	 *
	 * @return void
	 */
	abstract public function addConstraints();

	/**
	 * Set the constraints for an eager load of the relation.
	 *
	 * @param  array  $models
	 * @return void
	 */
	abstract public function addEagerConstraints(array $models);

	/**
	 * Initialize the relation on a set of models.
	 *
	 * @param  array   $models
	 * @param  string  $relation
	 * @return void
	 */
	abstract public function initRelation(array $models, $relation);

	/**
	 * Match the eagerly loaded results to their parents.
	 *
	 * @param  array   $models
	 * @param  Illuminate\Database\Eloquent\Collection  $results
	 * @param  string  $relation
	 * @return array
	 */
	abstract public function match(array $models, Collection $results, $relation);

	/**
	 * Get the results of the relationship.
	 *
	 * @return mixed
	 */
	abstract public function getResults();

	/**
	 * Get all of the primary keys for an array of models.
	 *
	 * @param  array  $models
	 * @return array
	 */
	protected function getKeys(array $models)
	{
		return array_values(array_map(function($value)
		{
			return $value->getKey();

		}, $models));
	}

	/**
	 * Get the underlying query for the relation.
	 *
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	public function getQuery()
	{
		return $this->query;
	}

	/**
	 * Handle dynamic method calls to the relationship.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		if (method_exists($this->query, $method))
		{
			return call_user_func_array(array($this->query, $method), $parameters);
		}

		throw new \BadMethodCallException("Method [$method] does not exist.");
	}

}