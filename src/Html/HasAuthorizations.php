<?php

namespace Yajra\DataTables\Html;

use Illuminate\Contracts\Auth\Access\Authorizable;

trait HasAuthorizations
{
    /**
     * Flag to check if user is authorized to use the button.
     *
     * @var bool
     */
    protected $authorized = true;

    /**
     * Make a button if condition is true.
     *
     * @param bool|callable $condition
     * @param string|array $options
     * @return static
     */
    public static function makeIf($condition, $options)
    {
        if (value($condition)) {
            return static::make($options);
        }

        return static::make([])->authorized(false);
    }

    /**
     * Make a button if the user is authorized.
     *
     * @param string $permission
     * @param string|array $options
     * @param Authorizable|null $user
     * @return static
     */
    public static function makeIfCan($permission, $options, Authorizable $user = null)
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        if ($user->can($permission)) {
            return static::make($options);
        }

        return static::make([])->authorized(false);
    }

    /**
     * Make a button if the user is not authorized.
     *
     * @param string $permission
     * @param string|array $options
     * @param Authorizable|null $user
     * @return static
     */
    public static function makeIfCannot($permission, $options, Authorizable $user = null)
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        if (! $user->can($permission)) {
            return static::make($options);
        }

        return static::make([])->authorized(false);
    }

    /**
     * Set authorization status of the button.
     *
     * @param bool|callable $bool
     * @return static
     */
    public function authorized($bool)
    {
        $this->authorized = value($bool);

        return $this;
    }

    /**
     * Convert the Fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        if ($this->authorized) {
            return parent::toArray();
        }

        return [];
    }
}
