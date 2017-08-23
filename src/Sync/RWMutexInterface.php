<?php

namespace Sync;

/**
 * An RWMutex is a reader/writer mutual exclusion lock. 
 * The lock can be held by an arbitrary number of readers or a single write
 */
interface RWMutexInterface extends MutexInterface 
{
    /**
     * Locks mutex for reading.
     * If the read lock or exclusive lock is alredy in use 
     * blocks process untill mutex is avalibale.
     *
     * Returns TRUE on success or FALSE on failure. 
     *
     * @param bool $wait - if set to FALSE would not block process
     *
     * @return bool
     */
    public function readLock($wait = TRUE); 

    /**
     * Unlocks mutex for reading.
     *
     * Returns TRUE on success or FALSE on failure. 
     *
     * @return bool
     */
    public function readUnlock();
}
