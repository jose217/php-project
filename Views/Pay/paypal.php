<?php if(!isset($_SESSION))
{
    session_start();
} ?>
<div class="mt-4 d-flex justify-content-center">
<script src="https://www.paypal.com/sdk/js?client-id=test"></script>
<script>paypal.Buttons().render('body');</script>
<script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '88.44'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }


        }).render('#paypal-button-container');
    </script>
</div>