<?php

declare(strict_types=1);

namespace Chocofamilyme\LaravelJaeger\Listeners;

use Chocofamilyme\LaravelJaeger\Jaeger;
use Illuminate\Database\Events\QueryExecuted;

final class QueryListener
{
    private Jaeger $jaeger;

    public function __construct(Jaeger $jaeger)
    {
        $this->jaeger = $jaeger;
    }

    public function handle(QueryExecuted $event): void
    {
        $this->jaeger->start("DB Query: {$event->sql}", [
            'query.sql'             => $event->sql,
            'query.bindings'        => $event->bindings,
            'query.connection_name' => $event->connectionName,
            'query.time'            => $event->time
        ]);
    }
}