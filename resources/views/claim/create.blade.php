@extends('layouts.dashboard')
@section('page-title')
    {{__('Create Claim')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">
              @if($displaytype=='create'){{__('Create Claim')}}@endif
              @if($displaytype=='edit'){{__('Edit Claim')}}@endif
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('claim.index')}}">{{__('Claim')}}</a></li>
                  <li class="breadcrumb-item active">
                    @if($displaytype=='create'){{__('Create')}}@endif
                    @if($displaytype=='edit'){{__('Edit')}}@endif
                  </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">
@if(Session::has('error'))
<span class="text-danger pl-1">{{ Session::get('error') }}</span><br>
@endif
@if($displaytype=='create')
<form method="post" action="{{route('claim.store')}}" enctype="multipart/form-data" id="myform">
@endif
@if($displaytype=='edit')
{{Form::model($claim,array('route' => array('claim.update', $claim->id), 'method' => 'PUT', 'id' => 'myform', 'enctype' => 'multipart/form-data')) }}
@endif
    @csrf
    <div class="row">
        <div class="col-md-12 ">
            <div class="card ">
                <!-- <div class="card-header"><h4>{{__('Claim Details')}}</h4></div> -->
                <div class="card-body ">

                    <div class="row">
                      <div class="col-md-3">
                          <div class="form-group" >
                            {!! Form::label('claim_id', __('Claim ID')) !!}<span class="text-danger pl-1">*</span>
                              {!! Form::text('id', $claim_id, ['class' => 'form-control','disabled'=>'disabled']) !!}
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group" >
                              {!! Form::label('claim_date', __('Claim Date')) !!}<span class="text-danger pl-1">*</span>
                              <input type="text" name="claimdate" @if($displaytype=='edit') value="{{ date('d-m-Y',strtotime($claim->claimdate))}}"  @endif id="claimdate" class="form-control datetime"   required >
                          </div>
                      </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               {!! Form::label('employee_name', __('Employee Name')) !!}<span class="text-danger pl-1">*</span>
                                <select name="employee_id"  required class="form-control" id="" @if($displaytype=='edit') disabled @endif>
                                   <option value="">Select Employee</option>
                                    @if($employees)
                                        @foreach($employees as $employee)
                                        <option value="{{$employee->id}}"  @if($displaytype=='edit') @if($employee->id==$claim->employee_id) selected='selected'  @endif @endif>{{$employee->first_name}} {{$employee->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group" >
                                    {!! Form::label('claim_name', __('Claim Name')) !!}<span class="text-danger pl-1">*</span>
                                    <input type="text" name="title"  id="title" class="form-control" @if($displaytype=='edit') value="{{$claim->title}}"  @endif  required>
                                </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('claim_status', __('Status')) !!}<span class="text-danger pl-1">*</span>
                                      <select name="status" required class="form-control">
                                            <option value="">Select Status</option>
                                            @if($claim_status_values)
                                                @foreach($claim_status_values as $key => $value)
                                                <option value="{{$key}}" @if($displaytype=='edit') @if($key==$claim->status) selected='selected'  @endif @endif   >{{$value}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                </div>
                        </div>

                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTables_wrapper claim-table" id="items">
                                <thead>
                                    <tr>
                                      <th class="text-left">{!! Form::label('item_name', __('Item Name')) !!}<span class="text-danger pl-1">*</span></th>
                                      <!-- <th class="text-center">Account Code</th> -->
                                      <th class="text-left">{!! Form::label('item_name', __('Quantity')) !!}<span class="text-danger pl-1">*</span></th>
                                      <th class="text-right">{!! Form::label('item_price', __('Price')) !!}<span class="text-danger pl-1">*</span></th>
                                      <th class="text-left">{!! Form::label('item_tax', __('Tax/GST')) !!}<span class="text-danger pl-1">*</span></th>
                                      <th class="text-right">{!! Form::label('item_total', __('Nett Total')) !!}</th>
                                      <th class="text-left">{!! Form::label('item_desc', __('Description')) !!}</th>
                                      <th class="text-left">{!! Form::label('item_attach', __('Attachment')) !!}</th>
                                      <th class="text-center">{!! Form::label('item_action', __('Actions')) !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @if($displaytype=='create')
                                    <tr  id="item-row-0">
                                        <td class="text-left typeahead-wrap">
                                            <input type="text" name="item[0][item_name]" required id="item-name-0" class="form-control typeahead" value="">
                                            <input name="item[0][item_id]" type="hidden"  id="item-id-0">
                                        </td>

                                        <td class="text-left typeahead-wrap">
                                            <input onchange="myCalculations();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"   type="text" value="0" id="item-quantity-0" required name="item[0][quantity]"  class="form-control w-80px">
                                        </td>
                                        <td class="text-left typeahead-wrap">
                                            <input onchange="myCalculations();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"  type="text" value="0" class="form-control w-80px" required name="item[0][price]" type="text" id="item-price-0">
                                        </td>
                                        <td class="typeahead-wrap">
                                            <select onchange="myCalculations();" onkeypress="this.onchange();"   class="form-control typeahead select2" required  name="item[0][tax_id]" id="item-tax-0" >
                                              <option value="">- Select Payable -</option>


                                              @if($claim_tax_values)
                                                  @foreach($claim_tax_values as $key => $value)
                                                  <option value="{{$key}}">{{$value}}</option>
                                                  @endforeach
                                              @endif

                                            </select>
                                        </td>
                                        <td class="text-center typeahead-wrap">
                                            <span id="item-total-0">0</span>
                                        </td>
                                        <td class="text-left typeahead-wrap">
                                            <textarea class="form-control custom-textarea"  name="item[0][description]" id="item-description-0" placeholder="Description"></textarea>
                                        </td>
                                        <td class="text-left typeahead-wrap">
                                            <input type="file" value="" name="item[0][document]" id="item-document-0" class="form-control">
                                        </td>
                                        <td class="text-center typeahead-wrap">
                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" data-original-title="Delete" onclick="$('.tooltip').remove(); $('#item-row-0').remove(); myCalculations(); ">
                                              <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endif

                                    @if($displaytype=='edit')

                                    @foreach($claim_items as $index => $claim_item)
                                   <tr  id="item-row-{{$index}}">
                                       <td class="text-left typeahead-wrap">
                                           <input type="text" name="item[{{$index}}][item_name]" required id="item-name-{{$index}}" class="form-control typeahead"  value="{{$claim_item->title}}">
                                           <input name="item[{{$index}}][item_id]" type="hidden" @if($displaytype=='edit') value="{{$claim_item->id}}"  @endif id="item-id-{{$index}}">
                                       </td>

                                       <td class="text-left typeahead-wrap">
                                           <input onchange="myCalculations();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"   type="text"  value="{{$claim_item->qty}}"  id="item-quantity-{{$index}}" required name="item[{{$index}}][quantity]"  class="form-control w-80px">
                                       </td>
                                       <td class="text-left typeahead-wrap">
                                           <input onchange="myCalculations();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"  type="text" value="{{$claim_item->price}}" class="form-control w-80px" required name="item[{{$index}}][price]" type="text" id="item-price-{{$index}}">
                                       </td>
                                       <td class="typeahead-wrap">
                                           <select onchange="myCalculations();" onkeypress="this.onchange();"   class="form-control typeahead select2" required  name="item[{{$index}}][tax_id]" id="item-tax-{{$index}}" >
                                             <option value="">- Select Payable -</option>


                                             @if($claim_tax_values)
                                                 @foreach($claim_tax_values as $key => $value)
                                                 <option value="{{$key}}"    @if($key==$claim_item->tax) selected='selected'  @endif >{{$value}}</option>
                                                 @endforeach
                                             @endif

                                           </select>
                                       </td>
                                       <td class="text-center typeahead-wrap">
                                           <span id="item-total-{{$index}}">0</span>
                                       </td>
                                       <td class="text-left typeahead-wrap">
                                           <textarea class="form-control custom-textarea"  name="item[{{$index}}][description]" id="item-description-{{$index}}" placeholder="Description">{{$claim_item->remark}}</textarea>
                                       </td>
                                       <td class="text-left typeahead-wrap">
                                           <input type="file" value="" name="item[{{$index}}][document]" id="item-document-{{$index}}" class="form-control">
                                           <em>Upload files only: png,jpg,jpeg,pdf,xlsx,csv</em><br/>
                                           @if($displaytype=='edit')
                                           @if(!empty($claim_item->documents))

                                           <a href="{{asset('public/uploads/document/'.$claim_item->documents)}}" class="" target="_blank">{{$claim_item->documents}}</a> <a href="javascript:void(0)" onclick="delete_clt_docs({{$claim_item->id}})" class="" style="color:red;">Remove</a><br/>

                                           @endif
                                           @endif
                                       </td>
                                       <td class="text-center typeahead-wrap">
                                           <button type="button" data-toggle="tooltip" title="" class="btn btn-xs btn-danger" data-original-title="Delete" onclick="$('.tooltip').remove(); $('#item-row-{{$index}}').remove(); myCalculations(); ">
                                             <i class="fa fa-trash"></i>
                                           </button>
                                       </td>
                                   </tr>
                                   @endforeach
                                   @endif


                                    <tr id="addItem">
                                        <td colspan="8" class="text-center">
                                          <button type="button" onclick="addItem();" data-toggle="tooltip" title="" class="btn btn-xs btn-success" data-original-title="Add">
                                            <i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="payment-options row">
                          <div class="col-sm-8"></div>
                          <div class="col-sm-4">
                            <table class="table no-border">
                              <tbody>
                                <tr>
                                    <td class="text-right" style="width: 50%;"><strong>{!! Form::label('claim_gross', __('Gross Total')) !!}</strong></td>
                                    <td class="text-right" style="width: 50%;"><span id="sub-total">0</span></td>
                                </tr>

                                <tr>
                                    <td class="text-right"><strong>{!! Form::label('claim_taxtotal', __('Tax Total')) !!}</strong></td>
                                    <td class="text-right"><span id="tax-total">0</span></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>{!! Form::label('claim_total', __('Nett Total')) !!}</strong></td>
                                    <td class="text-right"><span id="grand-total">0</span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              {!! Form::label('remark', __('Remark')) !!}<span class="text-danger pl-1">*</span>
                              <textarea name="remark" class="form-control" required >@if($displaytype=='edit') {{$claim->remark}} @endif</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                 {!! Form::label('documents', __('Upload Documents')) !!}
                             <input type="file" name="documents[]" class="form-control">
                             <input type="file" name="documents[]" class="form-control">
                             <input type="file" name="documents[]" class="form-control">
                             <input type="file" name="documents[]" class="form-control">
                             <input type="file" name="documents[]" class="form-control">
                             @if($displaytype=='edit')
                             <input type="hidden" name="edit_documents"  id="edit_documents"  value="{{$claim->documents}}"   >
                             @endif
                            </div>


                            <em>Upload files only: png,jpg,jpeg,pdf,xlsx,csv</em><br/>
                            @if($displaytype=='edit')
                            @if(!empty($claim->documents))
                            @foreach($claim_docs as $dkey => $dvalue)
                            <a href="{{asset('public/uploads/document/'.$dvalue)}}" class="" target="_blank">{{$dvalue}}</a> <a href="javascript:void(0)" onclick="delete_clm_docs('{{$dvalue}}',{{$claim->id}})" class="" style="color:red;">Remove</a><br/>
                            @endforeach
                            @endif
                            @endif
                        </div>


                    </div>
                    <div class="row">
                      <div class="col-md-12 ">
                        @if($displaytype=='create') {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!} @endif
                        @if($displaytype=='edit') {!! Form::submit('Update', ['class' => 'btn btn-success float-right']) !!} @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

{!! Form::close() !!}

@endsection

@push('script-page')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.8.2/tinymce.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


@if($displaytype=='edit')

function delete_clm_docs(image_id,claim_id)
{

if(confirm("Are you sure to delete this document file?"))
{
$.ajax({
        url: '{{route('claim.delete_clm_docs')}}',
        type: 'POST',
        data: {
            "image_id": image_id,"claim_id": claim_id, "_token": "{{ csrf_token() }}",
        },
        success: function (data) {

           window.location.href=data.image_id;
        }
    });
}
return false;
}

function delete_clt_docs(image_id)
{

if(confirm("Are you sure to delete this document file?"))
{
$.ajax({
        url: '{{route('claim.delete_clt_docs')}}',
        type: 'POST',
        data: {
            "image_id": image_id,"claim_id": "{{$claim->id}}","_token": "{{ csrf_token() }}",
        },
        success: function (data) {

           window.location.href=data.image_id;
        }
    });
}
return false;
}

@endif


// tinymce.init({
//       selector: '.custom-textarea',
//       height: 100,
//       menubar: false,
//       plugins: [
//         'lists',
//         'code',
//         'table contextmenu paste code'
//       ],
//       toolbar: 'code',
// });
$('.datetime').daterangepicker({
    locale: {
      format: 'DD-MM-YYYY'
    },
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');

  });
@if($displaytype=='create')
var item_row = 1;
@endif
@if($displaytype=='edit')
var item_row = {{count($claim_items)}};
@endif
function addItem() {
    html  = '<tr id="item-row-' + item_row + '">';

    html += '  <td class="text-left typeahead-wrap">';
    html += '      <input name="item[' + item_row + '][item_name]"  required="required" class="form-control typeahead" type="text" id="item-name-' + item_row + '">';
    html += '      <input name="item[' + item_row + '][item_id]" type="hidden" id="item-id-' + item_row + '">';
    html += '  </td>';

    html += '  <td class="text-left typeahead-wrap">';
    html += '      <input class="form-control w-80px" value="0"   onchange="myCalculations();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"  required="required" name="item[' + item_row + '][quantity]" type="text" id="item-quantity-' + item_row + '">';
    html += '  </td>';
    html += '  <td class="text-left typeahead-wrap">';
    html += '      <input class="form-control curr_amt w-80px"  onchange="myCalculations();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();"  value="0" required="required" name="item[' + item_row + '][price]" type="text" id="item-price-' + item_row + '">';
    html += '  </td>';
    html += '  <td class="text-left typeahead-wrap">';
    html += '      <select class="form-control select2 typeahead"    onchange="myCalculations();" onkeypress="this.onchange();"    required="required" name="item[' + item_row + '][tax_id]" id="item-tax-' + item_row + '">';
    html += '         <option selected="selected" value="">- Select Payable -</option>';
    @if($claim_tax_values)
        @foreach($claim_tax_values as $key => $value)
        html += '         <option value="{{$key}}">{{$value}}</option>';
        @endforeach
    @endif
    html += '      </select>';
    html += '  </td>';
    html += '  <td class="text-center typeahead-wrap"';
    html += '      <span id="item-total-' + item_row + '">0</span>';
    html += '  </td>';
    html += '  <td class="text-left typeahead-wrap">';
    html += '  <textarea class="form-control custom-textarea" placeholder="Description" name="item[' + item_row +'][description]" id="item-description-' + item_row + '" autocomplete="off"></textarea>';
    html += '  </td>';
    html += '  <td class="text-left typeahead-wrap">';
    html += '  <input type="file" value="" name="item[' + item_row +'][document]" id="item-document-' + item_row + '" class="form-control">';
    html += '  </td>';
    html += '  <td class="text-center typeahead-wrap">';
    html += '      <button type="button" onclick="$(\'.tooltip\').remove(); $(\'#item-row-' + item_row + '\').remove();  myCalculations(); " data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
    html += '  </td>';

    $('#items tbody #addItem').before(html);

    $('[data-toggle="tooltip"]').tooltip('hide');
    $('.select2').select2();

    // tinymce.init({
    //   selector: '.custom-textarea',
    //   height: 100,
    //   menubar: false,
    //   plugins: [
    //     'lists',
    //     'code',
    //     'table contextmenu paste code'
    //   ],
    //   toolbar: 'code',
    // });

    item_row++;
};



 function myCalculations() {
   var i=0;
   var noofrows = 0
   //var txt = 'item['+i+'][quantity]';
   //console.log('item['+i+'][quantity]');
  // var ctrl1 = document.getElementById(txt);
  var frm = document.getElementById('myform');
  const frmeleval = [];
   do {
     if(frm.elements[i].name.indexOf('quantity') != -1) {
       //console.log('');
       frmeleval[noofrows] = frm.elements[i].name;
       noofrows++;
     }

     i++;
   }
   while(i<frm.elements.length)
   const actfrmindexarr = [];
   for(j=0;j<noofrows;j++) {
     tmpexpl = frmeleval[j].split("[");
     tmpnextexpl = tmpexpl[1].split(']');
     actfrmindexarr[j] = tmpnextexpl[0];
     //console.log(frmeleval[j]);
   }
   i=0;
   const cur_qty = [];
   const cur_tax = [];
   const cur_price = [];
   do {

     if(frm.elements[i].name.indexOf('quantity') != -1) {
       //console.log('');
       for(j=0;j<actfrmindexarr.length;j++) {
         if('item['+actfrmindexarr[j]+'][quantity]'.valueOf() == frm.elements[i].name.valueOf())
         {
           if(actfrmindexarr[j] != null) {
             cur_qty[actfrmindexarr[j]] = frm.elements[i].value;
           }
         }
       }
     }


     if(frm.elements[i].name.indexOf('price') != -1) {
       //console.log('');
       for(j=0;j<actfrmindexarr.length;j++) {
         if('item['+actfrmindexarr[j]+'][price]'.valueOf() == frm.elements[i].name.valueOf())
         {
           if(actfrmindexarr[j] != null) {
             cur_price[actfrmindexarr[j]] = frm.elements[i].value;
           }
         }
       }
     }


     if(frm.elements[i].name.indexOf('tax_id') != -1) {
       //console.log('');
       for(j=0;j<actfrmindexarr.length;j++) {
         if('item['+actfrmindexarr[j]+'][tax_id]'.valueOf() == frm.elements[i].name.valueOf())
         {
           if(actfrmindexarr[j] != null) {
             cur_tax[actfrmindexarr[j]] = frm.elements[i].value;
           }
         }
       }
     }



     i++;
   }
   while(i<frm.elements.length)

   console.log(JSON.stringify(cur_price));
   console.log(JSON.stringify(cur_tax));

   console.log(JSON.stringify(cur_qty));
   console.log(JSON.stringify(actfrmindexarr));


   for(j=0;j<actfrmindexarr.length;j++) {
     var span = document.getElementById("item-total-"+actfrmindexarr[j]);
     span.innerText = cur_qty[actfrmindexarr[j]] * cur_price[actfrmindexarr[j]];
   }

   tot_gross = 0;
   tot_tax = 0;
   for(j=0;j<actfrmindexarr.length;j++) {
     var span = document.getElementById("item-total-"+actfrmindexarr[j]);
     line_val = cur_qty[actfrmindexarr[j]] * cur_price[actfrmindexarr[j]];
     tot_gross = tot_gross + line_val;
     if(cur_tax[actfrmindexarr[j]] == '{{$claim_tax_pcent[1]}}') {
       line_tax = (line_val * {{$claim_tax_pcent[0]}});
       tot_tax = tot_tax + line_tax;
     }
   }


   net_tot = tot_gross + tot_tax;
console.log(JSON.stringify(tot_gross));
console.log(JSON.stringify(tot_tax.toFixed(2)));
console.log(JSON.stringify(net_tot));

var spanst = document.getElementById("sub-total");
spanst.innerText = tot_gross.toFixed(2);


var spanstax = document.getElementById("tax-total");
spanstax.innerText = tot_tax.toFixed(2);


var spansg = document.getElementById("grand-total");
spansg.innerText = net_tot.toFixed(2);




 }



</script>
@if($displaytype=='edit')
<script>
window.omload = myCalculations();
</script>
@endif
@endpush
