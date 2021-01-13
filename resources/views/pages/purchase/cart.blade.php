@extends("template.master.purchase")

@section("styles")
<style>
.img{
    height: 70px;
    width: 70px;
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
                    <h4 class="card-title"> Items List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                            </thead>
                            <tbody id="item_list"></tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-12" style="text-align:right;">
                            <h3 id="total_items_label">0 Item</h3>
                            <h3 id="total_amount_label">Total of ₱0.00</h3>
                            <button id="checkout_btn" class="btn btn-success btn-lg" disabled>CHECKOUT NOW</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    var type = "<?=Auth::user()->type?>";
    $(document).ready(function(){
        getItems();
    });

    function getItems(){
        $.ajax({
            url: `/cart/items`,
            success: function(response){
                if(response.cart){
                    response.items.forEach(item => {
                        $("#item_list").append(`
                            <tr>
                                <td> <button class="btn btn-danger" onclick="removeItem(${item.id})">Remove</button> </td>
                                <td>
                                    <img src="${item.image}" class="img"/>
                                    ${item.name}
                                </td>
                                <td>${item.description}</td>
                                <td>₱${item.price.toLocaleString()}</td>
                            </tr>
                        `); 
                    });

                    $("#total_items_label").html(`${response.items.length.toLocaleString()} total item${response.items.length > 1 ? 's' : ''}`);
                    $("#total_amount_label").html(`Total of ₱${response.purchase.total_amount.toLocaleString()}`);
                    $("#checkout_btn").removeAttr("disabled").click(function() {
                        checkout();
                    });
                }
            }
        });
    }

    function checkout(){
        $.ajax({
            method: "POST",
            url: "/checkout",
            data: { _token: "<?=csrf_token()?>" },
            success: function(){
                window.location = `${type}/my-items`;
            },
            error: function(err){
                var body = err.responseJSON;
                if(body.hasOwnProperty("message")){
                    alert(body.message);
                    return;
                }

                alert("Something went wrong! Please try again later");
            }
        });
    }

    function removeItem(id){
        $.ajax({
            method: "POST",
            url: "/cart/remove",
            data: { id, _token: "<?=csrf_token()?>" },
            success: function(){
                window.location = `/cart`;
            },
            error: function(err){
                var body = err.responseJSON;
                if(body.hasOwnProperty("message")){
                    alert(body.message);
                    return;
                }

                alert("Something went wrong! Please try again later");
            }
        });
    }
</script>
@endsection