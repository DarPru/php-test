<?php

class ApiClient
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function fetchData()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            throw new \Exception('Ошибка при выполнении запроса к API');
        }

        return json_decode($response, true);
    }
}
