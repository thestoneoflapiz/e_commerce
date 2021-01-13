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
                    <h5 class="card-category">
                        <button class="btn btn-primary btn-sm" onclick="window.location='/seller/items/add'">Add Item</button>
                    </h5>
                    <h4 class="card-title"> Items List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th class="text-right">Status</th>
                            <th class="text-right">Actions</th>
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
            url: `/${type}/items/list`,
            success: function(response){
                response[0].forEach(item => {
                    $("#item_list").append(`
                        <tr>
                            <td>
                                <img src="${item.image}" class="img"/>
                                ${item.name}
                            </td>
                            <td>₱${item.price.toLocaleString()}</td>
                            <td>${item.description}</td>
                            <td class="text-right"><span class="badge badge-${item.status=="pending" ? "info" : (item.status=="approved" ? "success" : "danger")}">${item.status}</span></td>
                            <td class="text-right">
                                `+(
                                    type == "seller" ? `<button class="btn btn-success btn-sm" onclick="window.location='/seller/items/edit/${item.id}'">Update</button>` : 
                                    (
                                        item.status == "pending" ? `
                                        <button class="btn btn-success btn-sm" style="margin-bottom:4px;" onclick="change(${item.id}, 'approved')">Approve</button> <br/>
                                        <button class="btn btn-danger btn-sm" onclick="change(${item.id}, 'blocked')">Block</button>
                                    `: ""
                                    )
                                )+`
                            </td>
                        </tr>
                    `); 
                });
            }
        });
    }

    function change(id, status){
        $.ajax({
            method: "POST",
            url: `/${type}/items/status`,
            data: {
                id, status,
                _token: "<?=csrf_token()?>"
            },
            success: function(response){
                location.reload();
            },
            error: function(response){
              var body = response.responseJSON;
              if(body.hasOwnProperty("message")){
                alert(body.message);
                return;
              }

              alert("Unable to update! Please try again later.");
            }
        });
    }
</script>
@endsection