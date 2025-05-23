<?php

namespace RequestSqlTrace\RequestSqlLogger;

use Hyperf\Database\Events\QueryExecuted;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Context\Context;

class SqlQueryListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            QueryExecuted::class,
        ];
    }

    public function process(object $event): void
    {
        if (! $event instanceof QueryExecuted) {
            return;
        }

        $sqlLogs = Context::get('sql.logs', []);
        $sqlLogs[] = [
            'sql' => $event->sql,
            'bindings' => $event->bindings,
            'time' => $event->time . ' ms',
        ];
        Context::set('sql.logs', $sqlLogs);
    }
}
