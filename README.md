# Backend for WalletPi

## Requests

### Bank amount
GET

    http:193.2.178.88/walletWall/public/index.php/api/amount  
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
    
    http:193.2.178.88/walletWall/public/index.php/api/pay/{amount}/{walletid}
    
Response

    TODO      
    
### Is payment approved
GET

    http:193.2.178.88/walletWall/public/index.php/api/paymentapproved
     
Response

    TODO
    
        