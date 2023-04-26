$(document).ready(function(){
    $sub_total = Number($('#subTotal').text().replace('Ks',''));

    function getTotal() {
        $product_price = Number($parentNode.find('#product_price').text().replace('Ks',''));
        $total = Number($parentNode.find('#total').text().replace('Ks',''));
    }

    function showTotal($parentNode) {
        $parentNode.find('#total').html(`${$total} Ks`);
        $('#subTotal').html(`${$sub_total} Ks`);
        $('#totalPrice').html(`${$sub_total+3000} Ks`);
    }

    $('.btn-plus').click(function(){
        $parentNode = $(this).parents('tr');
        getTotal($parentNode);
        $total+=$product_price;
        $sub_total+= $product_price;
        showTotal($parentNode);
    })

    $('.btn-minus').click(function(){
        $parentNode = $(this).parents('tr');
        getTotal($parentNode);
        if(($parentNode.find('#total').text().replace('Ks','')) != 0) {
            $total-=$product_price;
            $sub_total-= $product_price;
            showTotal($parentNode);
        }
    })

    



});
