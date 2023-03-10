$(document).ready(function () {
  $('.select2').select2();
  $('[data-toggle="tooltip"]').tooltip({
      placement: 'right'
  });
  $('select[multiple]').    multiselect({
       includeSelectAllOption: true,
      placeholder: 'Please Select'
  });
});
