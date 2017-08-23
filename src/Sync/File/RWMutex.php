<?php

namespace Sync\File;

use Sync\File\Mutex;
use Sync\RWMutexInterface;

class RWMutex extends Mutex implements RWMutexInterface
{

    /**
     * {@inheritDoc}
     */
    public function readLock($wait = TRUE)
    {
        $op = LOCK_SH;
        if ( !$wait )
        {
            $op |= LOCK_NB; 
        }

        return $this->flock($op);
    }

    /**
     * {@inheritDoc}
     */
    public function readUnlock()
    {
        // since flock with argument LOCK_UN releases both shared and exclusive
        // locks there is no point to write somthing else.
        // TODO: prevent unlocking exclusive lock
        $this->unlock();  
    }
}
