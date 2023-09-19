# Replicate PHP client

A PHP client for [Replicate](https://replicate.com).
It lets you run models from your PHP code,
and everything else you can do with
[Replicate's HTTP API](https://replicate.com/docs/reference/http).

```php
use replicate\lib\Predictions;

$config = ['auth' => 'put your api key here'];
$predictions = new Predictions($config);

// 获取已经创建的预测列表
$res = $predictions->list();
print_r($res);

// 获取单个预测详情 (服务侧结果只保留1小时, 创建后及时获取内容, 或者使用 webhook 接收通知, 将预测结果持久化)
$res = $predictions->get('x5wz2klb6trqvatl7ugjkvzfte');
print_r($res);

// 创建预测(问答或绘图)
$options = [
    'version' => 'f4e2de70d66816a838a89eeeb621910adffb0dd0baba3976c96980970978018d',
    'input' => [
        'prompt' => 'How many states in USA?',
        // 'system_prompt' => 'You are a helpful, respectful and honest assistant.',
        // 'max_new_tokens' => 500,
        // 'min_new_tokens' => -1,
        // 'temperature' => 0.75,
        // 'top_p' => 1,
        // 'top_k' => 50,
        // 'stop_sequences' => '<end>,<stop>',
        // 'seed' => '',   // 留空则随机
    ],

    // https://replicate.com/docs/webhooks
    // 'webhook' => 'https://yourdomain.com/replicate/prediction', // 仅支持 https
    // 'webhook_events_filter' => ['start', 'output', 'logs', 'completed'], // 一般只选择 completed

    // 'stream' => false
];
$res = $predictions->create($options);
print_r($res);
```
