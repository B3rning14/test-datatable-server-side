import $ from 'jquery';

$(document).ready(function(){
  let dt = $('.dataTable').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'pageLength': 10,
    'ajax': {
      'url': Routing.generate('api_test'),
    },
    'columns': [
      { data: 'first_name' },
      { data: 'last_name' },
    ]
  });

  console.log(dt);
});
