@php
    use App\Utility;
    $users=\Auth::user();
    $currantLang = $users->currentLanguage();
    $languages=Utility::languages();
 $profile=asset(Storage::url('uploads/avatar/'));
@endphp
@extends('layouts.dashboard')
@section('page-title')
    {{__('Employee')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('View Employee')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('employee.index')}}">{{__('Employee')}}</a></li>
                  <li class="breadcrumb-item active">{{__('View')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

<div class="card">

<div class="card-body profile_section">
    <div class="row">
      <div class="col-md-12">
        <div class="profile-view">
          <div class="profile-img-wrap">
            <div class="profile-img">
    @if($employee->documents)
    <a href="#"><img alt="" src="{{asset('public/uploads/document/')}}/{{$employee->documents}}" class="rounded-circle mr-1"></a>
    @else
              <a href="#"><img alt="" src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}" class="rounded-circle mr-1"></a>
    @endif
            </div>
          </div>
          <div class="profile-basic">
            <div class="row">
              <div class="col-md-6">
                <div class="profile-info-left">
                  <h3 class="user-name m-t-0 mb-0">{{$employee->first_name}} {{$employee->last_name}}</h3>
                  <h6 class="text-muted">{{$designations[0]}}</h6>
                  <small class="text-muted"></small>
                  <ul class="personal-info">
                    <li>
                      <div class="title">Employee Type:</div>
                      <div class="text">{{$employee->emp_type}}</div>
                    </li>
                    <li>
                      <div class="title">Employee ID:</div>
                      <div class="text">{{$employeesId}}</div>
                    </li>
                    <li>
                      <div class="title">Date of Join:</div>
                      <div class="text">{{\Auth::user()->dateFormat($employee->company_doj)}}</div>
                    </li>
                    <li>
                      <div class="title">NOK: </div>
                      <div class="text">{{$employee->nok}}</div>
                    </li>

                  </ul>

                </div>
              </div>
              <div class="col-md-6">
                <ul class="personal-info">
                  <li>
                    <div class="title">Phone:</div>
                    <div class="text">{{$employee->phone}}</div>
                  </li>
                  <li>
                    <div class="title">Email:</div>
                    <div class="text">{{$employee->email}}</div>
                  </li>
                  <!-- <li>
                    <div class="title">Birthday:</div>
                    <div class="text">24th July</div>
                  </li> -->
                  <li>
                    <div class="title">Address:</div>
                    <div class="text">{{$employee->address}}</div>
                  </li>
                  <!-- <li>
                    <div class="title">Gender:</div>
                    <div class="text">Male</div>
                  </li> -->
                  <!-- <li>
                    <div class="title">Reports to:</div>
                    <div class="text">
                       <div class="avatar-box">
                        <div class="avatar avatar-xs">
                         <img alt="" src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}" class="rounded-circle mr-1">
                        </div>
                       </div>
                       <strong>Jeffery Lalor  </strong>
                    </div>
                  </li> -->
                </ul>
              </div>
            </div>
          </div>
          <div class="pro-edit">

            @can('Edit Employee')
              <!-- <a href="{{route('employee.edit',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="edit-icon">
                  <i class="fa fa-edit"></i>
              </a> -->
            @endcan
          </div>
        </div>
      </div>
    </div>

    <div class="tab-box">
      <div class="row user-tabs">
        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
          <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank &amp; Statutory</a></li>
          </ul>
        </div>
      </div>
    </div>


    <div id="emp_profile" class="pro-overview tab-pane active">
      <div class="row">
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Personal Informations</h3>
              <ul class="personal-info">
                <li>
                  <div class="title">Passport No.</div>
                  <div class="text">{{$employee_personal_info->passport_no}}</div>
                </li>
                <li>
                  <div class="title">Passport Exp Date.</div>
                  <div class="text">{{$employee_personal_info->passport_expire}}</div>
                </li>
                <li>
                  <div class="title">Tel</div>
                  <div class="text">{{$employee_personal_info->tel}}</div>
                </li>
                <li>
                  <div class="title">Nationality</div>
                  <div class="text">{{$employee_personal_info->nationality}}</div>
                </li>
                <li>
                  <div class="title">Religion</div>
                  <div class="text">{{$employee_personal_info->religion}}</div>
                </li>
                <li>
                  <div class="title">Marital status</div>
                  <div class="text">{{$employee_personal_info->marital_status}}</div>
                </li>
                <li>
                  <div class="title">Employment of spouse</div>
                  <div class="text">{{$employee_personal_info->spouse}}</div>
                </li>
                <li>
                  <div class="title">No. of children</div>
                  <div class="text">{{$employee_personal_info->no_of_child}}</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Emergency Contact</h3>
              <h5 class="section-title">Primary</h5>
              <ul class="personal-info">
                <li>
                  <div class="title">Name</div>
                  <div class="text">{{$employee_primary->emr_name1}}</div>
                </li>
                <li>
                  <div class="title">Relationship</div>
                  <div class="text">{{$employee_primary->emr_relation1}}</div>
                </li>
                <li>
                  <div class="title">Phone </div>
                  <div class="text">{{$employee_primary->emr_phone1}}, {{$employee_primary->emr_phone12}}</div>
                </li>
              </ul>
              <hr>
              <h5 class="section-title">Secondary</h5>
              <ul class="personal-info">
                <li>
                  <div class="title">Name</div>
                  <div class="text">{{$employee_secondry->emr_name2}}</div>
                </li>
                <li>
                  <div class="title">Relationship</div>
                  <div class="text">{{$employee_secondry->emr_relation2}}</div>
                </li>
                <li>
                  <div class="title">Phone </div>
                  <div class="text">{{$employee_secondry->emr_phone2}}, {{$employee_secondry->emr_phone22}}</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Bank information</h3>
              <ul class="personal-info">
                <li>
                  <div class="title">Bank name</div>
                  <div class="text">{{$employee_bank->bank_name}} </div>
                </li>
                <li>
                  <div class="title">Bank account No.</div>
                  <div class="text">{{$employee_bank->bank_account_no}}</div>
                </li>
                <li>
                  <div class="title">Bank Branch Code</div>
                  <div class="text">{{$employee_bank->bank_branch_code}} </div>
                </li>
                <li>
                  <div class="title">Unique No.</div>
                  <div class="text">{{$employee_bank->unique_no}} </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Family Informations</h3>
              <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                <table class="table table-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Relationship</th>
                      <th>Date of Birth</th>
                      <th>Phone</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($employee_family as $tem)
                    <tr>
                      <td>{{ $tem->emr_family_name2}}</td>
                      <td>{{ $tem->emr_family_relation2}}</td>
                      <td>{{ $tem->emr_dob}}</td>
                      <td>{{ $tem->emr_family_phone}}</td>
                      <!-- <td class="text-right">
                        <a href="#" class="dropdown-item"><i class="fa fa-edit m-r-5"></i> Edit</a>
                        <a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                      </td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Education Informations </h3>
              <div class="experience-box">
                <ul class="experience-list">
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">International College of Arts and Science (UG)</a>
                        <div>Bsc Computer Science</div>
                        <span class="time">2000 - 2003</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">International College of Arts and Science (PG)</a>
                        <div>Msc Computer Science</div>
                        <span class="time">2000 - 2003</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Experience Informations</h3>
              <div class="experience-box">
                <ul class="experience-list">
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">Web Designer at Zen Corporation</a>
                        <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">Web Designer at Ron-tech</a>
                        <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">Web Designer at Dalt Technology </a>
                        <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>

    <div class="tab-pane" id="bank_statutory">
      <div class="row">
        <div class="col-sm-6">
          <div class="card-body">
            <h3 class="card-title">Basic Salary Information</h3>
            <div class="experience-box">
              <ul class="experience-list">
                <li>
                  <div class="experience-user">
                    <div class="before-circle"></div>
                  </div>
                  <div class="experience-content">
                    <div class="timeline-content">
                      <a href="#/" class="name">Salary basis type</a>
                      <div>{{$employee_salary->salary_type}}</div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="experience-user">
                    <div class="before-circle"></div>
                  </div>
                  <div class="experience-content">
                    <div class="timeline-content">
                      <a href="#/" class="name">Salary amount </a>
                      <div>{{$employee_salary->salary_amount}}</div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="experience-user">
                    <div class="before-circle"></div>
                  </div>
                  <div class="experience-content">
                    <div class="timeline-content">
                      <a href="#/" class="name">Payment type</a>
                      <div>{{$employee_salary->payment_type}}</div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card-body">
            <h3 class="card-title">CPF Information</h3>
            <div class="experience-box">
              <ul class="experience-list">
                <li>
                  <div class="experience-user">
                    <div class="before-circle"></div>
                  </div>
                  <div class="experience-content">
                    <div class="timeline-content">
                      <a href="#/" class="name">CPF contribution</a>
                      <div>{{$employee_cpf->cpf_contribution}}</div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="experience-user">
                    <div class="before-circle"></div>
                  </div>
                  <div class="experience-content">
                    <div class="timeline-content">
                      <a href="#/" class="name">CPF No. </a>
                      <div>{{$employee_cpf->cpf_no}}</div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="experience-user">
                    <div class="before-circle"></div>
                  </div>
                  <div class="experience-content">
                    <div class="timeline-content">
                      <a href="#/" class="name">Employee CPF rate</a>
                      <div>{{$employee_cpf->emp_cpf_contribution}}</div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
