<?php

namespace WordpressTheme\Hooks\Admin;

/**
 * @property string $title
 * @property string $slug
 */
abstract class AbstractTab
{
    /**
     * The page's slug. Will be set when
     *
     * @var string
     */
    protected $pageSlug;

    /**
     * The tab's title. Required.
     *
     * @var string
     */
    protected $title;

    /**
     * The tab's slug. Optional.
     *
     * @var
     */
    protected $slug;

    /**
     * @param string $pageSlug
     */
    public function __construct(string $pageSlug)
    {
        $this->pageSlug = $pageSlug;
        $this->slug     = $this->slug ?? str_slug($this->title);
    }

    /**
     * @param string $property
     *
     * @return string|null
     */
    public function __get(string $property)
    {
        return $this->$property ?? null;
    }
}
