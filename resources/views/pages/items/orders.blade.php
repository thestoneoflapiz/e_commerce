@extends("template.master.admin")

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
                    <h4 class="card-title"> Sold Items List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Name</th>
                            <th>Selling Price</th>
                            <th>Status</th>
                            <th class="text-right">Total Amount</th>
                            <th class="text-right">Total Items</th>
                        </thead>
                        <tbody id="item_list"></tbody>
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
    var type = "<?=Auth::user()->type?>";
    $(document).ready(function(){
        getItems();
    });

    function getItems(){
        $.ajax({
            url: `/${type}/orders/list`,
            success: function(response){
                response[0].forEach(item => {
                    $("#item_list").append(`
                        <tr>
                            <td>
                                <img src="${item.image}" class="img"/>
                                ${item.name}
                            </td>
                            <td>₱${item.price.toLocaleString()}</td>
                            <td><span class="badge badge-${item.status=="pending" ? "info" : (item.status=="approved" ? "success" : "danger")}">${item.status}</span></td>
                            <td class="text-right">₱${item.total_amount.toLocaleString()}</td>
                            <td class="text-right">${item.total_items.toLocaleString()}</td>
                        </tr>
                    `); 
                });
            }
        });
    }
</script>
@endsection