# Slack-Yii2
Slack bot messages for log in Yii2 

v 1.0.1

_Install_:

```
composer require pashkinz92/slack-yii2 "*"
```

```
'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'pashkinz92\SlackLogger',
                'levels' => ['error'],
            ],
        ],
    ],
```


```
'components' => [
...
    'slack'=>[
            'class'=>'pashkinz92\SlackClient',
            'token'=>'',
            'channel'=>'',
        ],
...
],
```

_Use_:

```
    Yii::$app->slack->send('Hello!')
```
