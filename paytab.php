<?php

 const PAYMENT_TYPES = [
    '0' => ['name' => 'all', 'title' => 'PayTabs - All', 'currencies' => null],
    '1' => ['name' => 'stcpay', 'title' => 'PayTabs - StcPay', 'currencies' => ['SAR']],
    '2' => ['name' => 'stcpayqr', 'title' => 'PayTabs - StcPay(QR)', 'currencies' => ['SAR']],
    '3' => ['name' => 'applepay', 'title' => 'PayTabs - ApplePay', 'currencies' => ['AED', 'SAR']],
    '4' => ['name' => 'omannet', 'title' => 'PayTabs - OmanNet', 'currencies' => ['OMR']],
    '5' => ['name' => 'mada', 'title' => 'PayTabs - Mada', 'currencies' => ['SAR']],
    '6' => ['name' => 'creditcard', 'title' => 'PayTabs - CreditCard', 'currencies' => null],
    '7' => ['name' => 'sadad', 'title' => 'PayTabs - Sadad', 'currencies' => ['SAR']],
    '8' => ['name' => 'atfawry', 'title' => 'PayTabs - @Fawry', 'currencies' => ['EGP']],
    '9' => ['name' => 'knet', 'title' => 'PayTabs - KnPay', 'currencies' => ['KWD']],
    '10' => ['name' => 'amex', 'title' => 'PayTabs - Amex', 'currencies' => ['AED', 'SAR']],
    '11' => ['name' => 'valu', 'title' => 'PayTabs - valU', 'currencies' => ['EGP']],
];
    const BASE_URLS = [
        'ARE' => [
            'title' => 'United Arab Emirates',
            'endpoint' => 'https://secure.paytabs.com/'
        ],
        'SAU' => [
            'title' => 'Saudi Arabia',
            'endpoint' => 'https://secure.paytabs.sa/'
        ],
        'OMN' => [
            'title' => 'Oman',
            'endpoint' => 'https://secure-oman.paytabs.com/'
        ],
        'JOR' => [
            'title' => 'Jordan',
            'endpoint' => 'https://secure-jordan.paytabs.com/'
        ],
        'EGY' => [
            'title' => 'Egypt',
            'endpoint' => 'https://secure-egypt.paytabs.com/'
        ],
        'GLOBAL' => [
            'title' => 'Global',
            'endpoint' => 'https://secure-global.paytabs.com/'
        ],
        // 'DEMO' => [
        //     'title' => 'Demo',
        //     'endpoint' => 'https://secure-demo.paytabs.com/'
        // ],
    ];

    // const BASE_URL = 'https://secure.paytabs.com/';

    const URL_REQUEST = 'payment/request';
    const URL_QUERY = 'payment/query';

    const URL_TOKEN_QUERY = 'payment/token';
    const URL_TOKEN_DELETE = 'payment/token/delete';

    function redirect($url, $statusCode = 303)
    {
       header('Location: ' . $url, true, $statusCode);
       die();
    }

    function httpPost()
    {
        $requestParams = [
            "profile_id"        =>   "(int){profile_id}",// get behind company name in from dashbord {profile_id:company_name} 
            "tran_type"         =>   "sale",
            "tran_class"        =>   "ecom",
            "cart_description"  =>   "Description of the items/services",
            "cart_id"           =>   "Unique order reference",
            "cart_currency"     =>   "EGP",
            "cart_amount"       =>   "5", 
            "callback"          =>   "https://example.me", // function the paytab server will call after end from transaction to send transaction data 
            "return"            =>   "https://example2.me", // url the 
            "hide_shipping"     =>    true,
            "customer_details"  =>    [
                                        "name"=> "John Smith",
                                        "email"=> "jsmith@gmail.com",
                                        // "street1"=> "404, 11th st, void",
                                        // "city"=> "Dubai",
                                        // "country"=> "AE",
                                        "ip"=> $_SERVER['SERVER_ADDR']
                                      ]
        ];
        $headers = [
            'Content-Type: application/json',
            "Authorization: {Your Server_key}"
        ];
        $gateway_url ="https://secure-egypt.paytabs.com/payment/request/";
        try{
        $curl = curl_init();
            @curl_setopt($curl, CURLOPT_URL, $gateway_url);
            @curl_setopt($curl, CURLOPT_POST, true);
            @curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($requestParams));
            @curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            @curl_setopt($curl, CURLOPT_HEADER, false);
            @curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            @curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            @curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            @curl_setopt($curl, CURLOPT_VERBOSE, true);
            $response = json_decode(curl_exec($curl));
            
        curl_close($curl);
        redirect($response->redirect_url);
    }catch(Exception $e) {
       die (" error in conniction ");
      }
      
        return $response;
    }
    echo httpPost();
    
    die("<br>end");

?>
