<?php

namespace Yajra\DataTables\Html\Editor\Fields;

class DateTime extends Field
{
    protected string $type = 'datetime';

    /**
     * Make a new instance of a field.
     *
     * @param  array|string  $name
     * @param  string  $label
     * @return static
     */
    public static function make(array|string $name, string $label = ''): static
    {
        return parent::make($name, $label)->format('YYYY-MM-DD hh:mm a');
    }

    /**
     * Set format to military time (24 hrs).
     *
     * @return $this
     */
    public function military(): static
    {
        return $this->format('YYYY-MM-DD HH:mm');
    }

    /**
     * @param  \DateTime  $dateTime
     * @param  string  $format
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-min-max.html
     */
    public function minDate(\DateTime $dateTime, string $format = 'Y-m-d'): static
    {
        return $this->opts(['minDate' => "new Date('".$dateTime->format($format)."')"]);
    }

    /**
     * @param  \DateTime  $dateTime
     * @param  string  $format
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-min-max.html
     */
    public function maxDate(\DateTime $dateTime, string $format = 'Y-m-d'): static
    {
        return $this->opts(['maxDate' => "new Date('".$dateTime->format($format)."')"]);
    }

    /**
     * @param  bool  $state
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-week-numbers.html
     */
    public function showWeekNumber(bool $state = true): static
    {
        return $this->opts(['showWeekNumber' => $state]);
    }

    /**
     * @param  array  $days
     * @return $this
     * @see https://editor.datatables.net/examples/dates/options-disable-days.html
     */
    public function disableDays(array $days): static
    {
        return $this->opts(['disableDays' => $days]);
    }

    /**
     * @param  int  $minutes
     * @return $this
     * @see https://editor.datatables.net/examples/dates/time-increment.html
     */
    public function minutesIncrement(int $minutes): static
    {
        return $this->opts(['minutesIncrement' => $minutes]);
    }

    /**
     * @param  int  $seconds
     * @return $this
     * @see https://editor.datatables.net/examples/dates/time-increment.html
     */
    public function secondsIncrement(int $seconds): static
    {
        return $this->opts(['secondsIncrement' => $seconds]);
    }

    /**
     * @param  array  $hours
     * @return $this
     * @see https://editor.datatables.net/examples/dates/datetime.html
     */
    public function hoursAvailable(array $hours): static
    {
        return $this->opts(['hoursAvailable' => $hours]);
    }

    /**
     * @param  array  $minutes
     * @return $this
     * @see https://editor.datatables.net/examples/dates/datetime.html
     */
    public function minutesAvailable(array $minutes): static
    {
        return $this->opts(['minutesAvailable' => $minutes]);
    }
}
