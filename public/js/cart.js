$(document).ready(function(){
    // plus button click
    $('.btn-plus').click(function(){
        parentNode = $(this).parents("tr");
        price = Number(parentNode.find('#price').text().replace("Kyats",""));
        qty = Number(parentNode.find('#qty').val()) ;
        total = price * qty;
        parentNode.find('#total').html(`${total} Kyats`);
        summaryCaculation();
    })

    // minus button click
    $('.btn-minus').click(function(){
        parentNode = $(this).parents("tr");
        price = Number(parentNode.find('#price').text().replace("Kyats",""));
        qty = Number(parentNode.find('#qty').val()) ;
        total = price * qty;
        parentNode.find('#total').html(`${total} Kyats`);
        summaryCaculation();
    })



    // calculat final price for all
    function summaryCaculation(){
        totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row){
           totalPrice += Number($(row).find('#total').text().replace("Kyats",""));
        })

        $('#subTotalPrice').html(`${totalPrice} Kyats`);
        $('#finalPrice').html(`${totalPrice+1500} Kyats`);
    }
})
