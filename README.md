记录请求与 SQL 日志的中间件组件
==功能：打印request+sql相关信息
请求 + SQL 日志： {"request_time":"2025-05-23 16:00:47","method":"GET","uri":"http://localhost:9504/jq/specifyAlarmDetail/e3du?aaaccc=eHFqcA==","ip":"192.168.65.1",
"params":{"aaaccc":"eHFqcA=="},"duration":"553.58 ms","sqls":[{"sql":"select * from `police_situation` where `id` = ? limit 1","bindings":[1],"time":"11.5 ms"},
{"sql":"select `ps_id`, `related_id`, `type` from `ps_pivot` where `ps_id` = ?","bindings":[1],"time":"0.56 ms"}]} []

==使用方式：
【必须】
1.config/autoload/listeners.php加入
\RequestSqlTrace\RequestSqlLogger\SqlQueryListener::class

2.config/autoload/middlewares.php加入
\RequestSqlTrace\RequestSqlLogger\LoggerMiddleware::class

【可选】
1.config/autoload/logger.php新增渠道

'request' => [ // 新增的日志通道
    'handlers' => [
        [
            'class' => Monolog\Handler\StreamHandler::class,
            'constructor' => [
                'stream' => BASE_PATH . '/runtime/logs/request.log',
                'level' => Monolog\Logger::INFO,
            ],
        ],
    ],
]

