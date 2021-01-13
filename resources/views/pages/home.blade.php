@extends("template.master.main")

@section("styles")
<style>
.landing-page .section-team .team .team-player img{ max-width: 200px; max-height: 120px;}
.item---beautify{ 
    border:0.5x solid #888888; 
    margin: 10px;
    padding-top:3%; 
    border-radius: 10px;
    -webkit-box-shadow: 1px 1px 12px 0px #e4e1e1; 
    -moz-box-shadow: 1px 1px 12px 0px #e4e1e1;
    box-shadow: 1px 1px 12px 0px #e4e1e1;    
}
</style>
@endsection

@section("content")
<div class="section section-team text-center">
    <div class="container">
        <h2 class="title">What we are selling?</h2>
        <div class="team">
            <div class="row" id="item-slider"><div class="col-md-12" style="text-align:center;">No Items yet</div></div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function(){
        requestItems();
    });

    function requestItems() {
        $.ajax({
            url: "/items",
            success: function(response){
                generateItemList(response[0]);
            }
        });
    }

    function generateItemList(items){
        $("#item-slider").empty();
        
        items.forEach(item => {
            $("#item-slider").append(`
                <div class="col-md-4 item---beautify">
                    <div class="team-player">
                        <img src="${item.image}" alt="Thumbnail Image" class="img-fluid img-raised">
                        <h4 class="title">${item.name} <br/>₱${item.price.toLocaleString()}</h4>
                        <p class="description">${item.description}</p>
                        <button class="btn btn-primary" onclick="addToCart(${item.id})">Add to Cart</button>
                    </div>
                </div>
            `);
        });
    }

    function addToCart(id){
        $.ajax({
            method: "POST",
            url: "/cart/add",
            data: {
                id, _token: "<?=csrf_token()?>"
            },
            success: function(response){
                if(response.hasOwnProperty("login")){
                    if(response.login){
                        if(response.buyer){
                            window.location = "/cart";
                            return;
                        }

                        alert("Sorry! You're not allowed to buy items.");
                        return;
                    }
                    window.location = "/login";
                    return;
                }
                window.location = "/cart";
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