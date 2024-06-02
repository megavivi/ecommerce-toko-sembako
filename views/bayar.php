<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
</head>
<body>
    <h1>Payment Form</h1>
    <button onclick="pay()">Bayar Sekarang</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $this->config->item('client_key'); ?>"></script>
    <script>
        function pay() {
            fetch('<?php echo site_url("welcome/process_payment"); ?>')
                .then(response => response.json())
                .then(data => {
                    snap.pay(data, {
                        onSuccess: function(result) {
                            console.log('Payment successful!', result);
                            window.location.href = "<?php echo site_url('welcome/finish'); ?>";
                        },
                        onPending: function(result) {
                            console.log('Payment pending.', result);
                        },
                        onError: function(result) {
                            console.log('Payment error!', result);
                        }
                    });
                });
        }
    </script>
</body>
</html>