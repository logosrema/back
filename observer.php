<?php

 class Observer extends MEDOOHelper  {
    public static function observe(string $evt, array $params = []) {
       $provider = self::getActiveProvider($evt);
        return match ($evt) {
            "deposit"  => (new SmsProvider($provider))->sendsms($params),
            "withdrawal" => (new SmsProvider($provider))->sendsms($params),
            default => throw new InvalidArgumentException("Unknown event type: $evt"),
        };
    }

    public static function getActiveProvider(string $provider){
        $sql = match($provider){
            "deposit" => "SELECT sms_provider FROM sms_preferences WHERE status = 'active' AND deposit = 1",
            "withdrawal" => "SELECT sms_provider FROM sms_preferences WHERE status = 'active'  AND withdraw = 1"
        };
        $data = parent::query($sql)[0];
        return $data['sms_provider'] ?? null;
    }

    public static function getActiveEmailProvider(){

    }


}