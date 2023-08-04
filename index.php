<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />


<center>
  <form class= 'submit_form'>
<div class="form-group">
  <div class="col-md-6">
    <label for="name" class="form-label">Name</label>
    <input type="text" name = 'name' class="form-control" id="name">
   
  </div>
  <div class="col-md-6">
    <label for="address" class="form-label">Description</label>
    <input type="text" name = 'description' class="form-control" id="description">
  </div>
  <div class="col-md-6">
    <label for="address" class="form-label">Address</label>
    <input type="text" name = 'address' class="form-control" id="address">
  </div>
  <div class="form-group">
  <div class="col-md-6">
    <label for="state">country</label>
    <select name = 'country' class="form-control" id="country">
      <option>Kenya</option>
      <option>USA</option>
      <option>Germany</option>
     
    </select>
</div>

  <div class="form-group">
  <div class="col-md-6">
    <label for="state">State</label>
    <select name = 'state' class="form-control" id="state">
      <option>Nairobi</option>
      <option>New York</option>
      <option>Berlin</option>
     
    </select>
</div>

<div class="col-md-6">
    <label for="state">City</label>
    <select name = 'city' class="form-control" id="city">
      <option>Naivasha</option>
      <option></option>
      <option>Texas</option>
      <option>Frankfurt</option>
   
    </select>
</div>
  </div>
  <br>
  <button type="button" class="btn btn-primary"  onclick = 'addNewRow()'>Add product</button>
  <hr>
  <div>    
    <table width="100%" id="dtExample" class="display " cellspacing="0">    
        <thead>    
            <tr>    
    
                <th>S.No</th>    
                <th style="display:none;">Id</th>    
                <th>Product Name</th>    
                <th>Pice</th>    
                <th>Qt</th>    
                <th>Status</th>   
                <th></th>    
                <th></th>   
            </tr>    
        </thead>    
    </table>    
</div> 

<div id ="response_message"></div>
<input type = "text" id="added_data"/>
  <button type="button" id="submit_button"  onclick = 'submit_form()'class="btn btn-primary">Submit</button>

</form>
</center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src= 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'/>
  // <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
</script>
<script>

$(document).ready( function () {
  // $.fn.dataTableExt.sErrMode = 'throw';
    $('#dtExample').DataTable();
    fnLoadDataTableInstance()  
   
} );
  
function submit_form() {

  let data = $('.submit_form').serializeArray();
  //submit the form. 
  $.ajax({
    method: "POST",
    url: 'api/api.php',
    data: data,
    success: function(reply) {
      let response = JSON.parse(reply);
      if (response.status == 200){
        //data saved.
        $('.submit_form')[0].reset();
        $('#response_message').html('<p style="font-size:20, color:blue>'+ response.message+'</p>');


      }
      else{
        $('#response_message').html('<p style="font-size:20, color:red>'+ response.message+'</p>');
      }

    }

  })
}
   function fnLoadDataTableInstance() {    

       $('#dtExample').DataTable({    
           dom: 'Bfrtip',    
           data: [    
           { id: '101', name: 'xyproducts', age: 10, city: '01' },    
           { id: '102', name: 'xyproducts', age: 10, city: '01'  }     
       ]      ,    
           columns: [    
               {    
                   render: function (data, type, row, meta) {    
                       return meta.row + meta.settings._iDisplayStart + 1;    
                   }    
               },    
               { data: 'Product Name', class: 'editable text' },    
            { data: 'Price', class: 'editable text'  },    
            { data: 'Qt',class: 'editable text'  },
          
                 
           ],    
           "searching": false,    
           "paging": true,    
           "info": true,    
           "language": {    
               "emptyTable": "No data available"    
           },    
           "fnRowCallback": function (nRow, aData, iDisplayIndex) {    
               $("td:first", nRow).html(iDisplayIndex + 1);    
               return nRow;    
           },    
       })    
   }    

   $('#dtExample').DataTable({    
        dom: 'Bfrtip',    
        data: [    
           { id: '101',name: 'xyproducts', age: 10, city: '01'  },    
           { id: '102', name: 'xyproducts', age: 10, city: '01'  }    
       ]     ,    
        columns: [    
            {    
                render: function (data, type, row, meta) {    
                    return meta.row + meta.settings._iDisplayStart + 1;    
                }    
            },    
            { data: 'name', class: 'editable text' },    
            { data: 'age', class: 'editable text'  },    
            { data: 'city',class: 'editable text'  },  
             
            {    
                //edit button creation    
                render: function (data, type, row) {    
                    return createButton('edit', row.id);    
                }    
            },    
            {    
                //delete button creation    
                render: function (data, type, row) {    
                    return createButton('delete', row.id);    
                }    
            }    
        ],    
        "searching": false,    
        "paging": true,    
        "info": true,    
        "language": {    
            "emptyTable": "No data available"    
        },    
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {    
            $("td:first", nRow).html(iDisplayIndex + 1);    
            return nRow;    
        },    
    })    

function createButton(buttonType, rowID) {    
    var buttonText = buttonType == "edit" ? "Edit" : "Delete";    
    
    return '<button class="' + buttonType + '" type="button">' + buttonText+'</button>';    
}    

$('#dtExample').on('click', 'tbody td .edit', function (e) {    
    fnResetControls();    
    var dataTable = $('#dtExample').DataTable();    
    var clickedRow = $($(this).closest('td')).closest('tr');    
    $(clickedRow).find('td').each(function () {    
        // do your cool stuff    
        if ($(this).hasClass('editable')) {    
            if ($(this).hasClass('text')) {    
                var html = fnCreateTextBox($(this).html(), 'name');    
                $(this).html($(html))    
            }    
        }    
    });     
    
    
    $('#dtExample tbody tr td .update').removeClass('update').addClass('edit').html('Edit');    
    $('#dtExample tbody tr td .cancel').removeClass('cancel').addClass('delete').html('Delete');    
    $(clickedRow).find('td .edit').removeClass('edit').addClass('update').html('Update');    
    $(clickedRow).find('td .delete').removeClass('delete').addClass('cancel').html('Cancel');    
    
});    
    
$('#dtExample').on('click', 'tbody td .delete', function (e) {    
    fnResetControls();    
    var dataTable = $('#dtExample').DataTable();  
 

 dataTable 
        .row( $(this).parents('tr') )
        .remove()
        .draw();  
     
    
});   
$('#dtExample').on('click', 'tbody td .update', function (e) {    
    fnResetControls();   
     
    var dataTable = $('#dtExample').DataTable();  
 
//  var d = dataTable.row( this ).data();
//  let encoded  = '<?php json_encode('+d+')?>'
//  $('#added_data').val(d);

     
    
});  
function fnCreateTextBox(value, fieldprop) {    
    return '<input data-field="' + fieldprop + '" type="text" value="' + value + '" ></input>';    
}    
$('#dtExample').on('click', 'tbody td .cancel', function (e) {    
        fnResetControls();    
        $('#dtExample tbody tr td .update').removeClass('update').addClass('edit').html('Edit');    
        $('#dtExample tbody tr td .cancel').removeClass('cancel').addClass('delete').html('Delete');    
    });    
    
    
    function fnResetControls() {    
        var openedTextBox = $('#dtExample').find('input');    
        $.each(openedTextBox, function (k, $cell) {    
            $(openedTextBox[k]).closest('td').html($cell.value);    
        })    
    } 
    $('#dtExample').on('click', 'tbody td .update', function (e) {    
    
    var openedTextBox = $('#dtExample').find('input');    
    $.each(openedTextBox, function (k, $cell) {    
        fnUpdateDataTableValue($cell, $cell.value);    
        $(openedTextBox[k]).closest('td').html($cell.value);    
    })    
 
    $('#dtExample tbody tr td .update').removeClass('update').addClass('edit').html('Edit');    
    $('#dtExample tbody tr td .cancel').removeClass('cancel').addClass('delete').html('Delete');    
});    
 
function fnUpdateDataTableValue($inputCell, value) {    
    var dataTable = $('#dtExample').DataTable();    
    var rowIndex = dataTable.row($($inputCell).closest('tr')).index();    
    var fieldName = $($inputCell).attr('data-field');    
    dataTable.rows().data()[rowIndex][fieldName] = value;    
}    

function addNewRow() {
  
    fnResetControls();    
    var dataTable = $('#dtExample').DataTable();  
    let counter = 1;  
    dataTable.row
        .add([
          
            counter + '.1',
            counter + '.2',
            counter + '.3',
            counter + '.4',
            counter + '.5'
        ])
        .draw(false);
 
    counter++;
 
// const table = new DataTable('#example');  
    

}
function remove_record() {
  
  var dataTable = $('#dtExample').DataTable();  
 

  dataTable 
         .row( $(this).parents('tr') )
         .remove()
         .draw();
  

}

function add_to_form() {
  
  var dataTable = $('#dtExample').DataTable();  
 
  var d = dataTable.row( this ).data();

  $('#added_data').val() = d
  //add this data to the form. 
  

}
</script>
