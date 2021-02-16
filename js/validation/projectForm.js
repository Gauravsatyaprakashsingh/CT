$(document).ready(function () {

  $('#projectForm').validate({
    rules: {
      "project_name": {
        required: true,
        minlength: 5,
        digits: true
      }
    },
    messages: {
      "project_name": {
        required: "this field is required",
        minlength: "this field must contain at least {0} characters",
        digits: "this field can only contain numbers"
      }
    },
    submitHandler: function (form) { // for demo
      alert('valid form');
      return false;
    }
  });

});
