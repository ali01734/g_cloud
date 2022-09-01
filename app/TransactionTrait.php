<?php

namespace nataalam;

trait TransactionTrait
{
    /**
     * @before
     */
    public function beginDatabaseTransaction()
    {
        $this->app->make('db')->beginTransaction();

        $this->beforeApplicationDestroyed(function () {
            $this->app->make('db')->rollBack();
        });
    }
}