<?php

namespace Sync\File;

use Sync\MutexInterface;

class Mutex implements MutexInterface
{
    /**
     * Lock file resource
     *
     * @var $resource resource
     */
    protected $resource;

    /**
     * Mutex constructor.
     *
     * @param resource $resource
     *
     * @throws \InvalidArgumentExcpetion
     */
    public function __construct( $resource )
    {
        if ( !is_resource($resource) )
        {
            throw new \InvalidArgumentException(
                sprintf(
                    'Argument must be resource, %s given',
                    is_object($resource) ? get_class($resource) : gettype($resource)
                )
            );
        }

        $this->resource = $resource;
    }

    /**
     * {@inheritDoc}
     */
    public function lock($wait = TRUE)
    {
        $op = LOCK_EX;
        if ( !$wait )
        {
            $op |= LOCK_NB; 
        }

        return $this->flock($op);
    }

    /**
     * {@inheritDoc}
     */
    public function unlock()
    {
        return $this->flock(LOCK_UN);
    }

    /**
     * std flock wrapper
     * Returns TRUE on success or FALSE on failure. 
     *
     * @param int $operation - is one of the following:
     *
     * LOCK_SH to acquire a shared lock (reader).
     * LOCK_EX to acquire an exclusive lock (writer).
     * LOCK_UN to release a lock (shared or exclusive).
     *
     * @return bool
     */
    protected function flock( int $operation )
    {
        return flock($this->resource, $operation);
    }
}
