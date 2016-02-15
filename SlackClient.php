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

            $params['token'] = $this->token;
            $params['channel'] = $this->channel;
            if(is_array($text))
            {
                $params['attachments'] = json_encode($text);
            }
            else
            {
                $params['text'] = $text;
            }
            $params['as_user'] = 'true';
            /*$params['attachments'] = '[
            {
                "fallback": "Required plain-text summary of the attachment.",

                "color": "#36a64f",

                "pretext": "Optional text that appears above the attachment block",

                "author_name": "Bobby Tables",
                "author_link": "http://flickr.com/bobby/",
                "author_icon": "http://flickr.com/icons/bobby.jpg",

                "title": "Slack API Documentation",
                "title_link": "https://api.slack.com/",

                "text": "Optional text that appears within the attachment",

                "fields": [
                    {
                        "title": "Priority",
                        "value": "High",
                        "short": false
                    }
                ],

                "image_url": "http://my-website.com/path/to/image.jpg",
                "thumb_url": "http://example.com/path/to/thumb.png"
            }
        ]';*/

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