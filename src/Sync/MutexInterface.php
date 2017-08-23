<?php

namespace Sync;

/**
 * A Mutex is a mutual exclusion lock
 */
interface MutexInterface 
{

    /**
     * Locks mutex. 
     * If the lock is alredy in use blocks process untill mutex is avalibale
     *
     * Returns TRUE on success or FALSE on failure. 
     *
     * @param bool $wait - if set to FALSE would not block process
     *
     * @return bool
     */
    public function lock($wait = TRUE);

    /**
     * Unlocks mutex.
     * Returns TRUE on success or FALSE on failure. 
     *
     * @return bool
     */
    public function unlock();
}
