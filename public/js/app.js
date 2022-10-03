$(function()
{
  //...........................................................
  // Select2
  $('.searchable-select').select2(
  {
    width: "resolve",
    placeholder: {
      id: -1, // the value of the option
      text: "Selecione uma opção"
    },
    allowClear: true,
  });

  $('.multiple-searchable-select').select2(
  {
    width: "resolve",
    placeholder: {
      id: -1, // the value of the option
      text: "Selecione uma opção"
    },
    allowClear: true,
    multiple: true,
  });

});