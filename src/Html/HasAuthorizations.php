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
    protected bool $authorized = true;

    /**
     * Make a button if condition is true.
     *
     * @param  callable|bool  $condition
     * @param  array|string  $options
     * @return static
     */
    public static function makeIf(callable|bool $condition, array|string $options = [])
    {
        if (value($condition)) {
            return static::make($options);
        }

        return static::make([])->authorized(false);
    }

    /**
     * Make a button if the user is authorized.
     *
     * @param  string  $permission
     * @param  array|string  $options
     * @param  Authorizable|null  $user
     * @return static
     */
    public static function makeIfCan(string $permission, array|string $options = [], Authorizable $user = null)
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
     * @param  string  $permission
     * @param  array|string  $options
     * @param  Authorizable|null  $user
     * @return static
     */
    public static function makeIfCannot(
        string $permission,
        array|string $options = [],
        Authorizable $user = null
    ): static {
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
     * @param  callable|bool  $bool
     * @return static
     */
    public function authorized(callable|bool $bool): static
    {
        $this->authorized = value($bool);

        return $this;
    }

    /**
     * Convert the Fluent instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        if ($this->authorized) {
            return parent::toArray();
        }

        return [];
    }
}
