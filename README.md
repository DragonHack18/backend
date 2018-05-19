# Backend for WalletPi

## Requests

### Bank amount
GET

    http:193.2.178.88/dragonhack/public/index.php/api/amount  
    localhost/dragonhack/public/index.php/api/amount
Response

    [
        {
            id: "1",
            money: "500",
            payment_request: "20"
        }
    ]
  
### Request payment
GET
    
    http:193.2.178.88/dragonhack/public/index.php/api/pay/{amount}/{walletid}
    localhost/dragonhack/public/index.php/api/pay/{amount}/{walletid}
Response

    TODO      
    
### Is payment approved
GET

    http:193.2.178.88/dragonhack/public/index.php/api/paymentapproved
    localhost/dragonhack/public/index.php/api/paymentapproved 
Response

    TODO
    
        