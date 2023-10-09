<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use replicate\lib\Trainings;
use replicate\lib\Predictions;

$config = require(__DIR__ . '/config.php');
$trainings = new Trainings($config);

// 获取已经创建的训练列表
$res = $trainings->list();
print_r($res);

// 获取单个训练详情 (训练完成后及时获取内容, 或者使用 webhook 接收通知, 将预测结果持久化)
// 训练结果中的 output.weights 是模型或lora, 可以下载回来去别的地方使用
$res = $trainings->get('o3imoqlbuzaie5ftws552w6l2y');
print_r($res);

// 创建训练
$options = [
    'input' => [
        'input_images' => 'https://xxx.com/yyy.zip',
        // 更多参数详见当前模型的自述文件, 例如: https://replicate.com/stability-ai/sdxl#training-inputs
    ],
    'destination' => "<username>/<destination-model-name>"
];
// $training = $trainings->create('stability-ai', 'sdxl', '1bfb924045802467cf8869d96b231a12e6aa994abfe37e337c63a4e49a8c6c41', $options);
// print_r($training);

// 创建预测(绘图)
$predictions = new Predictions($config);
$options = [
    'version' => '00fa8de432d563e5bd6927a8c301361080053cc0e4baeb0b99da56967b0cad85',
    'input' => [
        'prompt' => 'A photo of TOK riding a rainbow unicorn',
        'negative_prompt' => 'soft, blurry, ugly',
        // 更多参数详见基座模型的API卡片, 例如: https://replicate.com/stability-ai/sdxl/api#inputs
    ],

    // https://replicate.com/docs/webhooks
    // 'webhook' => 'https://yourdomain.com/replicate/prediction', // 仅支持 https
    // 'webhook_events_filter' => ['start', 'output', 'logs', 'completed'], // 一般只选择 completed
];
// $res = $predictions->create($options);
// print_r($res);
