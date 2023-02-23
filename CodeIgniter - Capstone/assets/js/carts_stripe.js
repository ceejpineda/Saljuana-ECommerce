
$(document).ready(function(){

    $('#billing_checkbox').change(function() {
        // if the checkbox is checked
        if ($(this).is(':checked')) {
        // copy the values of the shipping input fields to the billing input fields
        $('input[name="first_name_bill"]').val($('input[name="first_name_ship"]').val());
        $('input[name="last_name_bill"]').val($('input[name="last_name_ship"]').val());
        $('input[name="address_bill"]').val($('input[name="address_ship"]').val());
        $('input[name="address2_bill"]').val($('input[name="address2_ship"]').val());
        $('input[name="city_bill"]').val($('input[name="city_ship"]').val());
        $('input[name="state_bill"]').val($('input[name="state_ship"]').val());
        $('input[name="zipcode_bill"]').val($('input[name="zipcode_ship"]').val());
        }
    });

    $(document).on('change', '.qty_cart', function(){
        $(this).parent().submit();
    })
    $(document).on('submit', '.modify_item_form', function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('.partialized').html(res);
        });
        return false;
    })

    $('#tryPay').on('click', function(){
        pay(Number($('#all_total').text()));
    })
    
    $(document).on('click', '.cart_delete', function(){
        var link = $(this);
        $.get(link.attr('href'), function(res){
            $('.partialized').html(res);
        });
        return false;
    })
    function pay(amount) {
        var handler = StripeCheckout.configure({
            key: 'pk_test_51MXHo7AKSx4zWvWkQZYZK3QubCyHuVnbJKQYzlfyQ3psAXrFkANreJoSu5Ec2YC51JNlQ7RmJ6nKcPUHHyUTadxv00Yw8K4bmd',
            locale: 'auto',
            token: function (token) {
                $('#token_response').html(JSON.stringify(token));
                $.ajax({
                    url:"/products/carts/pay_stripe",
                    method: 'post',
                    data: { tokenId: token.id, amount: amount },
                    dataType: "json",
                    success: function( response ) {
                        $('#paymentForm').submit();
                    }
                });
            }
        });
        handler.open({
            name: 'Saljuana Payment Portal',
            description: 'Checkout',
            amount: amount * 100
        });
    }
    
    $(document).on('submit', '#paymentForm', function(){
        console.log('pasok my friend');
    })
});