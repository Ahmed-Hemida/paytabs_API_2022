# PHP Native API Documentation for paytabs

You will need your server key in order to make these requests. This is not the same as the client key that is used within the managed payment pages. Authentication is done by including your server key in the 'Authorization:' header for the request.

The main details needed are your merchant profile ID (104459), the item cost, currency, description, a unique order reference, and either the callback URL or the return URL for your store (these URLs will only be used if the transaction required any form of browser redirection)

# #REQUEST

profile_id"           => get behind company name in from dashbord {profile_id:company_name} .
"callback"            =>   "https://example.me", // function the paytab server will call after completing his/her transaction to send transaction data to your server.
"return"              =>   "https://example2.me", // The page where the user will return after completing his/her translation.
"hide_shipping"       =>    true, If set to true , this will make shipping_details optional and it will not be displayed on the paypage. 

All requests must be sent using HTTP POST to the PayTabs transaction API endpoint:

curl --request POST \
  --url https://secure-egypt.paytabs.com/payment/request \
  --header 'authorization: Your profile server key' \
  --header 'content-type: application/json' \
  --data '{
    "profile_id": Your profile ID,
    "tran_type": "sale",
    "tran_class": "ecom" ,
    "cart_id":"4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
    "cart_description": "Dummy Order 35925502061445345",
    "cart_currency": "AED",
    "cart_amount": 46.17,
    "callback": "https://yourdomain.com/yourcallback",
    "return": "https://yourdomain.com/yourpage"
  }'

# #RESPONSES
The response from the transaction API can be grouped into 3 main categories:

Result:
If the transaction can be processed without requiring any additional details, then the response from the API will be the final transaction results.

& RESULT SAMPLE:
{
  "tran_ref": "TST2014900000688",
  "cart_id": "Sample Payment",
  "cart_description": "Sample Payment",
  "cart_currency": "AED",
  "cart_amount": "1",
  "customer_details": {
    "name": "John Smith",
    "email": "jsmith@gmail.com",
    "phone": "9711111111111",
    "street1": "404, 11th st, void",
    "city": "Dubai",
    "state": "DU",
    "country": "AE",
    "ip": "127.0.0.1"
  },
  "payment_result": {
    "response_status": "A",
    "response_code": "831000",
    "response_message": "Authorised",
    "acquirer_message": "ACCEPT",
    "acquirer_rrn": "014910159369",
    "transaction_time": "2020-05-28T14:35:38+04:00"
  },
  "payment_info": {
    "card_type": "Credit",
    "card_scheme": "Visa",
    "payment_description": "4111 11## #### 1111"
  }
}

# #Appendix
https://merchant-egypt.paytabs.com/merchant/developers/guides/transaction
