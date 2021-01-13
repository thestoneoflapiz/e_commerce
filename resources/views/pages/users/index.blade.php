@extends("template.master.admin")

@section("styles")
<style>
</style>
@endsection

@section("content")
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-category"></h5>
                    <h4 class="card-title"> Sellers List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Buyer Mode</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody id="seller_list"></tbody>
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
        getItems();
    });

    function getItems(){
        $.ajax({
            url: `/admin/sellers/list`,
            success: function(response){
                response[0].forEach(user => {
                    $("#seller_list").append(`
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.type}</td>
                            <td>${user.buyer_mode ? "on" : "off"}</td>
                            <td class="text-right">
                                `+(
                                    user.buyer_mode==0 ? `<button class="btn btn-success btn-sm" onclick="change(${user.id})">Set as Buyer</button>` : "" 
                                )+`
                            </td>
                        </tr>
                    `); 
                });
            }
        });
    }

    function change(id){
        $.ajax({
            method: "POST",
            url: `/admin/sellers/status`,
            data: {
                id,
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