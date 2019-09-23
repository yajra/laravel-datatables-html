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
     * @return Button
     */
    public static function makeIf($condition, $options)
    {
        if (value($condition)) {
            return static::make($options);
        }

        return static::make()->authorized(false);
    }

    /**
     * Make a button if condition is true.
     *
     * @param string $permission
     * @param string|array $options
     * @param Authorizable|null $user
     * @return Button
     */
    public static function makeIfCan($permission, $options, Authorizable $user = null)
    {
        if (is_null($user)) {
            $user = auth()->user();
        }

        if ($user->can($permission)) {
            return static::make($options);
        }

        return static::make()->authorized(false);
    }

    /**
     * Set authotization status of the button.
     *
     * @param bool|callable $bool
     * @return $this
     */
    public function authorized($bool)
    {
        $this->authorized = value($bool);

        return $this;
    }
}
