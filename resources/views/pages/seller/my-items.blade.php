@extends("template.master.admin")

@section("styles")
<style>
    .img{
        height: 70px;
        width: 70px;
    }

    .child-table{
        margin: 20px;
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        -webkit-box-shadow: 1px 2px 9px 0px #e4e4e4;
        -moz-box-shadow: 1px 2px 9px 0px #e4e4e4;
        box-shadow: 1px 2px 9px 0px #e4e4e4;    
    }
</style>
@endsection

@section("content")
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-category"></h5>
                    <h4 class="card-title"> My items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Purchase #</th>
                            <th>Purchased at</th>
                            <th>Total Amount</th>
                            <th>Total Items</th>
                        </thead>
                        <tbody id="purchase_list"></tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function(){
        getPurchaseAndItems();
    });

    function getPurchaseAndItems(){
        $.ajax({
            url: `/seller/my-items/list`,
            success: function(response){
               response[0].forEach(purchase => {
                    $("#purchase_list").append(`
                        <tr>
                            <td>purchase#${purchase.id}</td>
                            <td>${purchase.purchased_at}</td>
                            <td>₱${purchase.total_amount.toLocaleString()}</td>
                            <td>${purchase.total_items}</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table class="table child-table">
                                    <thead>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                    </thead>
                                    <tbody id="items_list${purchase.id}">
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    `); 

                    purchase.items.forEach(item => {
                        $(`#items_list${purchase.id}`).append(`
                            <tr>
                                <td>${item.name} </td>
                                <td>₱${item.price.toLocaleString()}</td>
                                <td>${item.description}</td>
                            </tr>
                        `); 
                    });
                });

            }
        });
    }

    
</script>
@endsection