<?php

namespace Dply\CMS\Traits\QueryCache;

use Illuminate\Database\Eloquent\Collection;
use Dply\CMS\Observers\FlushQueryCacheObserver;
use Dply\CMS\Support\Query\Builder;

/**
 * @method static bool flushQueryCache(array $tags = [])
 * @method static bool flushQueryCacheWithTag(string $string)
 * @method static \Illuminate\Database\Query\Builder|static cacheFor(\DateTime|int|null $time)
 * @method static \Illuminate\Database\Query\Builder|static cacheForever()
 * @method static \Illuminate\Database\Query\Builder|static dontCache()
 * @method static \Illuminate\Database\Query\Builder|static doNotCache()
 * @method static \Illuminate\Database\Query\Builder|static cachePrefix(string $prefix)
 * @method static \Illuminate\Database\Query\Builder|static cacheTags(array $cacheTags = [])
 * @method static \Illuminate\Database\Query\Builder|static appendCacheTags(array $cacheTags = [])
 * @method static \Illuminate\Database\Query\Builder|static cacheDriver(string $cacheDriver)
 * @method static \Illuminate\Database\Query\Builder|static cacheBaseTags(array $tags = [])
 */
trait QueryCacheable
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootQueryCacheable(): void
    {
        $flushCacheOnUpdate = !isset(static::$flushCacheOnUpdate) || static::$flushCacheOnUpdate;

        if ($flushCacheOnUpdate) {
            static::observe(
                static::getFlushQueryCacheObserver()
            );
        }
    }

    /**
     * Get the observer class name that will
     * observe the changes and will invalidate the cache
     * upon database change.
     *
     * @return string
     */
    protected static function getFlushQueryCacheObserver(): string
    {
        return FlushQueryCacheObserver::class;
    }

    /**
     * Set the base cache tags that will be present
     * on all queries.
     *
     * @return array
     */
    protected function getCacheBaseTags(): array
    {
        return [
            (string) static::class,
        ];
    }

    /**
     * When invalidating automatically on update, you can specify
     * which tags to invalidate.
     *
     * @param  string|null  $relation
     * @param  Collection|null  $pivotedModels
     * @return array
     */
    public function getCacheTagsToInvalidateOnUpdate(
        ?string $relation = null,
        Collection|null $pivotedModels = null
    ): array {
        return $this->getCacheBaseTags();
    }

    protected function newBaseQueryBuilder(): Builder
    {
        $connection = $this->getConnection();

        $builder = new Builder(
            $connection,
            $connection->getQueryGrammar(),
            $connection->getPostProcessor()
        );

        $builder->dontCache();

        if ($this->cacheFor) {
            $builder->cacheFor($this->cacheFor);
        }

        if (method_exists($this, 'cacheForValue')) {
            $builder->cacheFor($this->cacheForValue($builder));
        }

        if ($this->cacheTags) {
            $builder->cacheTags($this->cacheTags);
        }

        if (method_exists($this, 'cacheTagsValue')) {
            $builder->cacheTags($this->cacheTagsValue($builder));
        }

        if ($this->cachePrefix) {
            $builder->cachePrefix($this->cachePrefix);
        }

        if (method_exists($this, 'cachePrefixValue')) {
            $builder->cachePrefix($this->cachePrefixValue($builder));
        }

        if ($this->cacheDriver) {
            $builder->cacheDriver($this->cacheDriver);
        }

        if (method_exists($this, 'cacheDriverValue')) {
            $builder->cacheDriver($this->cacheDriverValue($builder));
        }

        if ($this->cacheUsePlainKey) {
            $builder->withPlainKey();
        }

        if (method_exists($this, 'cacheUsePlainKeyValue')) {
            $builder->withPlainKey($this->cacheUsePlainKeyValue($builder));
        }

        return $builder->cacheBaseTags($this->getCacheBaseTags());
    }
}
