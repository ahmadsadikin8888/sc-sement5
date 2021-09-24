<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>test</p>    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $.ajax({ 
    type: "POST",
    headers: {
        "Content-Type" : "application/json",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "DELETE, POST, GET, OPTIONS",
        "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With",

    },
    data: '{"grant_type": "client_credentials", "client_id":"d6520459-9e03-4dfb-814b-d8740b2a48cc", "client_secret":"2a7411ff-0c4e-49ec-9858-b45e8c09912b"}',
    url: "https://apigwsit.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
    success: function(data){        
        const accessToken = data.access_token;

        <?php foreach($data_lead as $data_lead) { ?>
        $.ajax({ 
        type: "POST",
        headers: {
            "Content-Type" : "application/json",
            "Authorization" : `Bearer ${accessToken}`,
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Methods": "DELETE, POST, GET, OPTIONS",
            "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With",

        },
        data: '{"ND": "<?php echo $data_lead["no_speedy"]; ?>"}',
        url: "https://apigwsit.telkom.co.id:7777/gateway/telkom-trems-tagihan/1.0/infoTagihan",
        success: function(data){
            const customerName = data.SUMMARY_CUSTOMER[0].NAME1;
            const customerPayment = data.SUMMARY_BILLING;

            $.ajax({
                url : "<?= base_url('index.php/payment/payment/insert') ?>",
                type : "POST",
                dataType : "json",
                data : {"name" : customerName, "payment" : customerPayment, "no_internet": "<?php echo $data_lead["no_speedy"]; ?>", "ncli": "<?php echo $data_lead["ncli"]; ?>"},
                success : function(data) {
                    console.log(data);
                    console.log("success");
                },
                error : function(data) {
                    // do something
                }
            });

            
        }
        });
        <?php } ?>
    }
    });
</script>
</html>