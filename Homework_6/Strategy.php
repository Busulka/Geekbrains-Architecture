<?php

interface IPayment {
    public function payOrder($amount, $phone);
}

class QiwiPayment implements IPayment {
    public function payOrder($amount, $phone) {
        echo "Стоимость: " . $amount . "<br>" .
            "Телефон: " . $phone . "<br>" .
            "Оплачено с помощью Qiwi" . "<br>";
    }
}

class YandexPayment implements IPayment {
    public function payOrder($amount, $phone) {
        echo "Стоимость: " . $amount . "<br>" .
            "Телефон: " . $phone . "<br>" .
            "Оплачено с помощью Yandex" . "<br>";
    }
}

class WebMoneyPayment implements IPayment {
    public function payOrder($amount, $phone) {
        echo "Стоимость: " . $amount . "<br>" .
            "Телефон: " . $phone . "<br>" .
            "Оплачено с помощью WebMoney" . "<br>";
    }
}

function buySocks(IPayment $payment, $phone) {
    $amount = 30.2;
    $payment->payOrder($amount, $phone);
}

buySocks(new YandexPayment(), "+71934567891");

buySocks(new QiwiPayment(), "+71234567891");

buySocks(new WebMoneyPayment(), "+71234567894");
