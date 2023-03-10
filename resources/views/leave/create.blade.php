@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<style>
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.img-delete {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.img-delete:hover {
  background: white;
  color: black;
}
</style>
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Leave Application')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('leave.index')}}">{{__('Leave')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Create')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">


<form method="post" action="{{route('leave.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12 ">
            <div class="card ">
                <!-- <div class="card-header"><h4>{{__('Leave Details')}}</h4></div> -->
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                               <label>Name</label><span class="text-danger pl-1">*</span>
                                <select name="emp_id" required class="form-control select2" id="emp_id" required>
                                    <option value="">Select Employee</option>
                                    @if(!empty($employees))
                                        @foreach($employees as $row)
                                            <option value="{{$row->id}}">{{$row->first_name}} {{$row->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4" id="department_div" style="display:none">
                            <div class="form-group">
                               <label>Department Name</label><span class="text-danger pl-1">*</span>

                               <input type="text" name="" value=""  id="department_id" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-4" id="designations_div" style="display:none">
                            <div class="form-group">
                               <label>Designations</label><span class="text-danger pl-1">*</span>

                               <input type="text" name="" value="" id="designations_id" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Date</label><span class="text-danger pl-1">*</span>

                                <input type="text" name="applied_on" value=""  id="applied_on" class="form-control datetime" >
                             </div>
                         </div>
                    </div>



                  @if(!empty($leavetypes))
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4><b>Leave Type</b></h4>
                      </div>
                        @foreach($leavetypes as $row)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <div class="form-check form-check-flat">
                                  <label class="form-check-label">
                                  <input type="radio" class="form-check-input" onclick="get_radio_value('{{$row->id}}#{{$row->title}}')" id="leave_type_id" name="leave_type_id" value="{{$row->id}}" required=""> {{$row->title}}<i class="input-helper"></i>
                                  </label>
                              </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-3 col-sm-6 col-xs-12" id="reason_type" style="display:none;">
                             <div class="form-group">
                                <input type="text" name="remark" value=""  id="remark" class="form-control" placeholder="If other please add reason here" >
                             </div>
                         </div>
                    </div>
                  @endif

                  <div class="row">
                    <div class="col-md-6">
                      <div class="demo-upload-container">
                          <div class="custom-file-container" data-upload-id="myFirstImage">
                            <div class="form-group">
                              <label>Upload Documents</label>
                              <input type="file" id="multiple_files" name="multiple_files[]" multiple />
                              <em class="w-100">Please Upload PDF, PNG, JPG, JPEG format</em>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2" id="npl">
                      <div class="col-md-12">
                        <h4><b>Number Of Days :</b></h4>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Taken From-Date*</label>
                                    <input autocomplete="off" type="text" class="form-control datetime" name="start_date" id="start_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Leave Taken Type From*</label>
                                    <select class="form-control required" name="from_time" id="from_time" required>
                                        <option value="">Select Taken Type</option>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                        <option value="Full">Full Day</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Taken To-Date*</label>
                                    <input autocomplete="off" type="text" class="form-control datetime" name="end_date" id="end_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-form-label">Leave Taken Type To*</label>
                                    <select class="form-control required" name="end_time" id="end_time" required>
                                        <option value="">Select Taken Type</option>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                        <option value="Full">Full Day</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="col-form-label"><b>Reason(s): *</b></label>
                                <textarea class="form-control required" rows="4" name="leave_reason" id="leave_reason"> {{old('leave_reason')}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="col-form-label">Country</label>
                                <select class="form-control" name="country" required>
                                <option value="">Select Country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia (Plurinational State of)">Bolivia (Plurinational State of)</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Belize">Belize</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Congo (Republic of the)">Congo (Republic of the)</option>
                                <option value="Congo (Democratic Republic of the)">Congo (Democratic Republic of the)</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Benin">Benin</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="Åland Islands">Åland Islands</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Palestine, State of">Palestine, State of</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                <option value="Vatican City State">Vatican City State</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Korea (Democratic People's Republic of)">Korea (Democratic People's Republic of)</option>
                                <option value="Korea (Republic of)">Korea (Republic of)</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Moldova (Republic of)">Moldova (Republic of)</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Oman">Oman</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Curaçao">Curaçao</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Norway">Norway</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Micronesia (Federated States of)">Micronesia (Federated States of)</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Palau">Palau</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Réunion">Réunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Barthélemy">Saint Barthélemy</option>
                                <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                                <option value="Spain">Spain</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="Macedonia (the former Yugoslav Republic of)">Macedonia (the former Yugoslav Republic of)</option>
                                <option value="Egypt">Egypt</option>
                                <option value="United Kingdom of Great Britain and Northern Ireland">United Kingdom of Great Britain and Northern Ireland</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="United States of America">United States of America</option>
                                <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Venezuela (Bolivarian Republic of)">Venezuela (Bolivarian Republic of)</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Samoa">Samoa</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="col-form-label">City</label>
                                <input type="text" class="form-control" name="city" value="{{old('city')}}" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="col-form-label">No of Days</label>
                                <input type="text" class="form-control" name="total_leave_days" id="total_leave_days" value="{{old('total_leave_days')}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{!! Form::close() !!}

@endsection

@push('script-page')
<script>
$('.datetime').daterangepicker({

            singleDatePicker: true,

            locale: {
                format: 'DD-MM-YYYY'
            }

        });
  </script>
    <script>

$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#multiple_files").on("change", function(e) {
      var multiple_files = e.target.files,
        filesLength = multiple_files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = multiple_files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/>" +
            "</span>").insertAfter("#multiple_files");
          $(".img-delete").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("|Sorry, | Your browser doesn't support to File API")
  }
});

        function get_radio_value(check_value)
        {

            var arr = check_value.split('#');
            if(arr[1]=='Others')
            {

                document.getElementById('remark').value = '';
                $("#reason_type").show();
            }
            else
            {
                document.getElementById('remark').value = '';

                $("#reason_type").hide();
            }

        }
        $(document).ready(function(){



                $("#emp_id").on("change",function(){
                        var emp_id=$(this).val();
                        if(emp_id==''){

                            $("#department_div").hide();
                            $("#designations_div").hide();

                            return false;
                        }
                        else
                        {
                            $.ajax({
                                url: '{{route('leave.json')}}',
                                type: 'POST',
                                data: {
                                "emp_id": emp_id, "_token": "{{ csrf_token() }}",
                                },
                                success: function (data) {
                                            console.log(data.get_depatment.name)
                                            $("#department_div").show();
                                            $("#designations_div").show();

                                            $("#department_id").val(data.get_depatment.name);
                                            $("#designations_id").val(data.get_designations.name);
                                }
                            });
                        }

                });
        });
        </script>

@endpush
