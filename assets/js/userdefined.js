$(document).ready(function(){
    $('#update_ProfilePic').click(function(){
        var image_name = $('#image').val();
        if(image_name == '') {
             alert("Please Select Image");
             return false;
        }
        else {
             var extension = $('#image').val().split('.').pop().toLowerCase();
             if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
             {
                  alert('Invalid Image File');
                  $('#image').val('');
                  return false;
             }
        }

    });
});

// For image upload preview----------------
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img_preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  readURL(this);
  $("#img_preview").toggleClass('d-none');
  $("#update_ProfilePic").toggleClass('d-none');


});
//-------------------------------------------
