@extends("template.master.admin")

@section("styles")
<style>
    .required{
        color: red;
        font-weight: 700;
    }

    #error_alert_msgs{display:none;}
</style>
@endsection

@section("content")
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-category"></h5>
                    <h4 class="card-title"> Edit Item # {{ $item->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" id="error_alert_msgs">
                        <div class="container error-messages"></div>
                    </div>
                    <form id="form" class="form">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" placeholder="Ex: My Bag | BRANDED!" class="form-control" name="name" value="{{ $item->name }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>Image <span class="required">*</span></label>
                                    <input type="text" placeholder="Ex: https://google.com/my-image" class="form-control" name="image" value="{{ $item->image }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label>Description <span class="required">*</span></label>
                                    <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label>Price <span class="required">*</span></label>
                                    <input type="text" placeholder="Ex: 1500" class="form-control" name="price" value="{{ $item->price }}">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5%;">
                           <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Update</button>
                           </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function(){
      $("#form").validate({
        rules: {
          name: {
            required: true,
            maxlength: 100,
          },
          image: {
            required: true,
            maxlength: 255,
          },
          description: {
            required: true,
            maxlength: 500,
          },
          price: {
            required: true,
            min: 1,
            max: 1000000,
          },
        },
        messages: {
            name: {
            required: "Please provide a name",
            maxlength: "Please input character no longer than 100",
          },
          image: {
            required: "Please provide an image",
            maxlength: "Please input character no longer than 255",
          },
          description: {
            required: "Please provide a description",
            maxlength: "Please input character no longer than 500",
          },
          price: {
            required: "Please provide a price",
            min: "Please input price no lower than 1",
            max: "Please input price no higher than 1000000",
          },
        },
        errorElement : 'div',
        errorLabelContainer: '.error-messages',
        invalidHandler: function(form, validator) {
          $("#error_alert_msgs").show();
        },
        submitHandler: function(form) {
          $.ajax({
            method: "POST",
            url: "/seller/items/update",
            data: {
                id: <?=$item->id?>,
                name: $('[name="name"]').val(),
                image: $('[name="image"]').val(),
                description: $('[name="description"]').val(),
                price: $('[name="price"]').val(),
              _token: "<?=csrf_token()?>"
            },
            success: function(response){
                window.location="/seller/items";
            },
            error: function(response){
              var body = response.responseJSON;
              if(body.hasOwnProperty("message")){
                alert(body.message);
                return;
              }

              alert("Unable to login! Please try again later.");
            }
          });
        }
      });
    });
</script>
@endsection