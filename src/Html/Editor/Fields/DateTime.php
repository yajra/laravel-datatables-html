<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class DateTime extends Field
{
    protected $type = 'datetime';

    /**
     * Make a new instance of a field.
     *
     * @param string $name
     * @param string $label
     * @return static
     */
    public static function make($name, $label = '')
    {
        return parent::make($name, $label)->format('YYYY-MM-DD hh:mm a');
    }

    /**
     * Set format to military time (24 hrs).
     *
     * @return $this
     */
    public function military()
    {
        return $this->format('YYYY-MM-DD HH:mm');
    }

    /**
     * @param \DateTime $dateTime
     * @param string $format
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-min-max.html
     */
    public function minDate(\DateTime $dateTime, $format = 'Y-m-d')
    {
        $this->attributes['opts']['minDate'] = "new Date('" . $dateTime->format($format) . "')";

        return $this;
    }

    /**
     * @param \DateTime $dateTime
     * @param string $format
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-min-max.html
     */
    public function maxDate(\DateTime $dateTime, $format = 'Y-m-d')
    {
        $this->attributes['opts']['maxDate'] = "new Date('" . $dateTime->format($format) . "')";

        return $this;
    }

    /**
     * @param bool $state
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-week-numbers.html
     */
    public function showWeekNumber($state = true)
    {
        $this->attributes['opts']['showWeekNumber'] = $state;

        return $this;
    }

    /**
     * @param array $days
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-disable-days.html
     */
    public function disableDays(array $days)
    {
        $this->attributes['opts']['disableDays'] = $days;

        return $this;
    }

    /**
     * @param int $minutes
     * @return $this
     * @see https://editor.datatables.net/examples/dates/time-increment.html
     */
    public function minutesIncrement($minutes)
    {
        $this->attributes['opts']['minutesIncrement'] = $minutes;

        return $this;
    }

    /**
     * @param int $seconds
     * @return $this
     * @see https://editor.datatables.net/examples/dates/time-increment.html
     */
    public function secondsIncrement($seconds)
    {
        $this->attributes['opts']['secondsIncrement'] = $seconds;

        return $this;
    }

    /**
     * @param array $hours
     * @return $this
     * @see https://editor.datatables.net/examples/dates/datetime.html
     */
    public function hoursAvailable(array $hours)
    {
        $this->attributes['opts']['hoursAvailable'] = $hours;

        return $this;
    }

    /**
     * @param array $minutes
     * @return $this
     * @see https://editor.datatables.net/examples/dates/datetime.html
     */
    public function minutesAvailable(array $minutes)
    {
        $this->attributes['opts']['minutesAvailable'] = $minutes;

        return $this;
    }
}
