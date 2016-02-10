<?php

namespace pashkinz92;

class SlackClient
{
    private $url = 'https://slack.com/api/chat.postMessage';

    var $token = false;
    var $channel = false;

    function send($text)
    {

        if(!$this->token || !$this->channel)
        {
            return;
        }

        if( is_array($text) )
        {
            $text = json_encode($text);
        }

        $params['token'] = $this->token;
        $params['channel'] = $this->channel;
        $params['text'] = $text;
        $params['as_user'] = 'true';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
    }

}

/*


https://github.com/Understeam/yii2-slack

namespace understeam\slack;
use GuzzleHttp\Post\PostBody;
use understeam\httpclient\Event;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

class Client extends Component
{
    public $url;
    public $username;
    public $emoji;
    public $httpclient = 'httpclient';
    public function init()
    {
        if (is_string($this->httpclient)) {
            $this->httpclient = Yii::$app->get($this->httpclient);
        } elseif (is_array($this->httpclient)) {
            if (!isset($this->httpclient['class'])) {
                $this->httpclient['class'] = \understeam\httpclient\Client::className();
            }
            $this->httpclient = Yii::createObject($this->httpclient);
        }
        if (!$this->httpclient instanceof \understeam\httpclient\Client) {
            throw new InvalidConfigException("Client::httpclient must be either a Http client instance or the application component ID of a Http client.");
        }
    }
    public function send($text = null, $icon = null, $attachments = [])
    {
        $self = $this;
        $this->httpclient->request($this->url, 'POST', function (Event $event) use ($self, $text, $icon, $attachments) {
            $request = $event->message;
            $body = new PostBody();
            $body->setField('payload', Json::encode($self->getPayload($text, $icon, $attachments)));
            $request->setBody($body);
        });
    }
    protected function getPayload($text = null, $icon = null, $attachments = [])
    {
        if ($text === null) {
            $text = 'Yii message from ' . Yii::$app->id;
        }
        $payload = [
            'text' => $text,
            'username' => $this->username,
            'attachments' => $attachments,
        ];
        if ($icon !== null) {
            $payload['icon_emoji'] = $icon;
        }
        return $payload;
    }
}


 */