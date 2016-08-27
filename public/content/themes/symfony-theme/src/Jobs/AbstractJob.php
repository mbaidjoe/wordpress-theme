<?php

namespace SymfonyTheme\Jobs;

use SymfonyTheme\Exceptions\JobException;

/**
 * AbstractJob class.
 */
abstract class AbstractJob implements JobInterface
{
    /**
     * The slug of the cron job.
     *
     * @var string
     */
    protected $slug = '';

    /**
     * The recurrence slug of the cron job.
     *
     * @var string
     */
    protected $recurrenceSlug = 'daily';

    /**
     * The interval in seconds between each cron job. Only required with custom recurrences.
     *
     * @var int
     */
    protected $recurrenceInterval = 0;

    /**
     * The name of recurrence. Only required with custom recurrences.
     *
     * @var string
     */
    protected $recurrenceName = '';

    /**
     * The date format for the first cron job.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d 03:01:00';

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Adds a cron job.
     */
    public function activate()
    {
        if (wp_next_scheduled($this->slug) === false) {
            wp_schedule_event(
                strtotime(date($this->dateFormat)),
                $this->recurrenceSlug,
                $this->slug
            );
        }
    }

    /**
     * Removes the scheduled cron job.
     */
    public function deactivate()
    {
        wp_clear_scheduled_hook($this->slug);
    }

    /**
     * Filters the schedules and adds a custom interval.
     *
     * @throws JobException
     */
    public function addInterval()
    {
        add_filter('cron_schedules', function (array $schedules) {
            if (in_array($this->recurrenceSlug, $schedules)) {
                return $schedules;
            }

            if (empty($this->recurrenceInterval) || empty($this->recurrenceName)) {
                throw new JobException('Interval and/or name missing');
            }

            $schedules[$this->recurrenceSlug] = [
                'interval' => $this->recurrenceInterval,
                'display'  => $this->recurrenceName,
            ];

            return $schedules;
        });
    }
}
