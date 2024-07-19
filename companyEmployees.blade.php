@extends('layouts.home')
@section('title')
    <title>{{ str_replace('-', ' ', $employees[0]->name) }} Employees | HR-Soft</title>
@endsection
@section('content')
<style>
    #toastBox{
        position: absolute;
        top: 100px;
        right: 30px;
        display: flex;
        align-items: flex-end;
        flex-direction: column;
        overflow: hidden;
        padding: 20px;
    }
    .toast{
        width: 400px;
        height: 80px;
        background: #fff;
        font-weight: 500;
        margin: 15px 0;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
    }

    /* .modal-dialog{ */

        .add-doc-modal







        {

        

        position: absolute;
    top: 0px;
    left: 22%;
    width: 44%;
    display: none;
    z-index: 999999999;
    border: 1px solid #f1e9e9;
    background-color: #fbfbfb;
    /* transform: scale(0);
    transition: transform 2s ease-in-out; */
   }   
   
   /* .add-doc-modal{
    transform: scale(1);

   } */
   
   #addDoceModalLabel{
    padding-left: 10px
   }
</style>
    <div class="header-divider"></div>
    
    <div class="body flex-grow-1 px-3">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title text-capitalize">{{ str_replace('-', ' ', $employees[0]->name) }} Employees</h3>
                @if ($users->status == 0)
                    <div class="d-flex">
                        <select class="form-select" id="problem" aria-label="Employee Status">
                            <option value="Permanent">Permanent </option>
                            <option value="Training">Training </option>
                            <option value="Notice">Notice </option>
                            <option value="Resigned">Resigned </option>
                        </select>
                    <a href="javascript:void(0);" data-coreui-toggle="modal" data-coreui-target="#empRegisterModal" style="white-space: nowrap"
                        class="btn btn-primary mx-4"><svg class="icon icon-md">
                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                        </svg> Add Employee</a>
                    </div>
                @endif
            </div>
            <div class="modal fade" id="empRegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Employee to
                                {{ str_replace('-', ' ', $employees[0]->name) }}</h5>
                            <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('add.employee') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $employees[0]->company_id }}"> 
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                                        </svg></span>
                                    <input placeholder="Name" id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                        </svg></span>
                                    <input placeholder="Username" id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    {{-- error msg --}}
                                        <span class="invalid-feedback errorMsg" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user-plus"></use>
                                        </svg></span>
                                    <select name="shift" id="" class="form-control">
                                        <option value="" selected>Select Shift</option>
                                        <option value="US">USA Shift</option>
                                        <option value="IN">India Shift</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input placeholder="Password" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input placeholder="Repeat Password" id="password-confirm" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                                <button class="btn btn-block btn-success text-white" type="submit" onclick="showToast(errorMsg)">Create Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- toast --}}

            <div id="toastBox"></div>
            {{-- toast end--}}



            <div class="card-body table-responsive permanent">
                <table id="example" class="table table-striped table-bordered" style="width:100%"
                    data-order="[[ 1, &quot;asc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>contact</th>
                            <th>email</th>
                            <th>DOB</th>
                            <th>gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $emp)
                            <tr>
                                <td>{{ $emp->empcode }}</td>
                                <td>{{ $emp->fname }}</td>
                                <td>{{ $emp->lname }}</td>
                                <td>{{ $emp->emp_status }}</td>
                                <td>{{ $emp->contact }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->dob }}</td>
                                <td>{{ $emp->gender }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" data-coreui-toggle="modal"
                                            data-coreui-target="#showEmployee{{ $emp->id }}"
                                            class="btn btn-sm btn-primary m-2">Show</a>
                                        <div class="modal fade" id="showEmployee{{ $emp->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details of
                                                            {{ $emp->fname }} {{ $emp->lname }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <button class="nav-link active fw-bold"
                                                                    id="nav-profile-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-profile{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-profile{{ $emp->id }}"
                                                                    aria-selected="true">Profile</button>
                                                                <button class="nav-link fw-bold" id="nav-office-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-office{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-office{{ $emp->id }}"
                                                                    aria-selected="false">Office</button>
                                                                <button class="nav-link fw-bold" id="nav-department-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-department{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-department{{ $emp->id }}"
                                                                    aria-selected="false">Department</button>
                                                                <button class="nav-link fw-bold"
                                                                    id="nav-qualification-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-qualification{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-qualification{{ $emp->id }}"
                                                                    aria-selected="false">Qualification</button>
                                                                <button class="nav-link fw-bold" id="nav-address-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-address{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-address{{ $emp->id }}"
                                                                    aria-selected="false">Address</button>
                                                                <button class="nav-link fw-bold" id="nav-bank-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-bank{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-bank{{ $emp->id }}"
                                                                    aria-selected="false">Bank</button>

                                                                    <button class="nav-link fw-bold" id="nav-document-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-document{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-document{{ $emp->id }}"
                                                                    aria-selected="false">Document</button>

                                                                    <button class="nav-link fw-bold" id="nav-resume-tab{{ $emp->id }}"
                                                                        data-coreui-toggle="tab"
                                                                        data-coreui-target="#nav-resume{{ $emp->id }}" type="button"
                                                                        role="tab" aria-controls="nav-resume{{ $emp->id }}"
                                                                        aria-selected="false">Resume</button>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" id="nav-tabContent">
                                                            <div class="tab-pane fade show active" id="nav-profile{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-profile-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <td>{{ $emp->fname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Middle Name</th>
                                                                            <td>{{ $emp->mname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Last Name</th>
                                                                            <td>{{ $emp->lname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Contact Number</th>
                                                                            <td>{{ $emp->contact }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email ID</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>DOB</th>
                                                                            <td>{{ $emp->dob }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Blood Group</th>
                                                                            <td>{{ $emp->blood }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Gender</th>
                                                                            <td>{{ $emp->gender }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Marital Status</th>
                                                                            <td>{{ $emp->marital }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Spouse Name</th>
                                                                            <td>{{ $emp->spouse }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Name</th>
                                                                            <td>{{ $emp->father }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Occupation</th>
                                                                            <td>{{ $emp->foccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Name</th>
                                                                            <td>{{ $emp->mother }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Occupation</th>
                                                                            <td>{{ $emp->moccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Name</th>
                                                                            <td>{{ $emp->emername }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Number</th>
                                                                            <td>{{ $emp->emernumber }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-office{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-office-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Username</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Date of Joining</th>
                                                                            <td>{{ $emp->joined_on }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Shift</th>
                                                                            <td>{{ $emp->shift }}</td>
                                                                        </tr>
                                                                        @if ($emp->shift == 'IN')
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>12:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>09:00 PM</td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>07:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>04:00 AM</td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <th>Status</th>
                                                                            <td>{{ $emp->emp_status }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-department{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-department-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Department</th>
                                                                            <td>{{ $emp->department }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Designation</th>
                                                                            <td>{{ $emp->designation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Manager</th>
                                                                            <td>{{ $emp->manager }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-qualification{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-qualification-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Qualification</th>
                                                                            <td>{{ $emp->qualification }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Education</th>
                                                                            <td>{{ $emp->education }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-address{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-address-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <h4>Permanent Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->perm_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->perm_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->perm_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->perm_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->perm_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                    <h4 class="mt-5">Temporary Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->temp_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->temp_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->temp_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->temp_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->temp_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-bank{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-bank-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>PAN</th>
                                                                            <td>{{ $emp->pancard }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Aadhaar</th>
                                                                            <td>{{ $emp->aadhaar }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>UAN</th>
                                                                            <td>{{ $emp->uan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Name</th>
                                                                            <td>{{ $emp->bank_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Acc Number</th>
                                                                            <td>{{ $emp->acc_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Branch</th>
                                                                            <td>{{ $emp->bank_branch }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>IFSC</th>
                                                                            <td>{{ $emp->ifsc }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="tab-pane fade" id="nav-document{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-document-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">





                                                                   <div class="col-md-12 d-flex justify-content-end">
                                                                         <!-- Button trigger modal -->
                                                                        <!-- Button trigger modal -->
                                                                        <div class="col-md-12 d-flex justify-content-end">                                                                                                                                            
                                                                            <button class="btn btn-sm btn-primary m-2 open" onclick="openAddDocModal(this.id)" id="addDocModal{{ $emp->id }}">Add Docs</button>
                                                                                                                                                                                                                          
                                                                       </div>

                                                                       {{-- <div class="col-md-12 d-flex justify-content-end">                                                                                                                                            
                                                                        <button class="btn btn-sm btn-primary m-2" id="open1">Add Docs</button>
                                                                                                                                                                                                                      
                                                                   </div> --}}
                                                                       
                                                                        <!-- Modal --> 
                                                                        
                                                                        <!-- Modal -->
                                                                        <div class="modal-dialog modal-lg add-doc-modal" id="addDocModal">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="addDoceModalLabel">Test Modal</h5>
                                                                                    <button type="button" class="btn-close" id="clsModal" data-coreui-dismiss="modal" aria-label="Close" ></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form method="POST" action="{{ url('documents/upload/'.$emp->id) }}" method="POST" enctype="multipart/form-data">
                                                                                        <div class="input-group mb-3"><span class="input-group-text">
                                                                                                <svg class="icon">
                                                                                                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                                                                                </svg></span>
                                                                                            {{-- <input placeholder="Name" id="name" type="text" class="form-control " name="name" value=""
                                                                                                required="" autocomplete="name" autofocus=""> --}}

                                                                                                <input type="file" name="images[]" class="form-control">
                                                                                        </div>
                                                                                        <button type="submit" class="btn btn-block btn-success text-white"  onclick="showToast(errorMsg)">Upload</button>
                                               
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>    
                                                                     <!-- Modal start -->

                                                                    <!-------- Modal end ---------->
                                                                   </div>


                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        {{-- <tr>
                                                                            <th>Document</th>
                                                                             <td><a href="{{ url('/view-docements',$emp->id) }}" class="btn btn-success">View</a></td> 
                                                                             <td><a href="{{ url('/add-Documents',$emp->id) }}" class="btn btn-success">Add Document</a></td> 
                                                                            <!-- Button trigger modal -->
                                                                            
                                                                        </tr> --}}
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download',$emp->documents_2) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table> 
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-resume{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-resume-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-resume',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download-resume',$emp->resume) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>
    
    
                                                        

                                                           
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white"
                                                            data-coreui-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       @if(Auth::user()->status == 0)
                                        <a href="/edit-employee/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-secondary m-2">Edit</a>
                                        @endif
                                        <a href="/edit-payroll/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-dark m-2">Salary Details</a>
                                        <a href="/hike/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-warning m-2">Hike</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             <div class="card-body table-responsive training" style="display:none;">
                <table id="example1" class="table table-striped table-bordered" style="width:100%"
                    data-order="[[ 1, &quot;asc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>contact</th>
                            <th>email</th>
                            <th>DOB</th>
                            <th>gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeestraining as $emp)
                            <tr>
                                <td>{{ $emp->empcode }}</td>
                                <td>{{ $emp->fname }}</td>
                                <td>{{ $emp->lname }}</td>
                                <td>{{ $emp->emp_status }}</td>
                                <td>{{ $emp->contact }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->dob }}</td>
                                <td>{{ $emp->gender }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" data-coreui-toggle="modal"
                                            data-coreui-target="#showEmployee{{ $emp->id }}"
                                            class="btn btn-sm btn-primary m-2">Show</a>
                                        <div class="modal fade" id="showEmployee{{ $emp->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details of
                                                            {{ $emp->fname }} {{ $emp->lname }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <button class="nav-link active fw-bold"
                                                                    id="nav-profile-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-profile{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-profile{{ $emp->id }}"
                                                                    aria-selected="true">Profile</button>
                                                                <button class="nav-link fw-bold" id="nav-office-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-office{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-office{{ $emp->id }}"
                                                                    aria-selected="false">Office</button>
                                                                <button class="nav-link fw-bold" id="nav-department-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-department{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-department{{ $emp->id }}"
                                                                    aria-selected="false">Department</button>
                                                                <button class="nav-link fw-bold"
                                                                    id="nav-qualification-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-qualification{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-qualification{{ $emp->id }}"
                                                                    aria-selected="false">Qualification</button>
                                                                <button class="nav-link fw-bold" id="nav-address-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-address{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-address{{ $emp->id }}"
                                                                    aria-selected="false">Address</button>
                                                                <button class="nav-link fw-bold" id="nav-bank-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-bank{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-bank{{ $emp->id }}"
                                                                    aria-selected="false">Bank</button>

                                                                    <button class="nav-link fw-bold" id="nav-document-tab{{ $emp->id }}"
                                                                        data-coreui-toggle="tab"
                                                                        data-coreui-target="#nav-document{{ $emp->id }}" type="button"
                                                                        role="tab" aria-controls="nav-document{{ $emp->id }}"
                                                                        aria-selected="false">Document</button>
    
                                                                        <button class="nav-link fw-bold" id="nav-resume-tab{{ $emp->id }}"
                                                                            data-coreui-toggle="tab"
                                                                            data-coreui-target="#nav-resume{{ $emp->id }}" type="button"
                                                                            role="tab" aria-controls="nav-resume{{ $emp->id }}"
                                                                            aria-selected="false">Resume</button>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" id="nav-tabContent">
                                                            <div class="tab-pane fade show active" id="nav-profile{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-profile-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <td>{{ $emp->fname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Middle Name</th>
                                                                            <td>{{ $emp->mname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Last Name</th>
                                                                            <td>{{ $emp->lname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Contact Number</th>
                                                                            <td>{{ $emp->contact }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email ID</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>DOB</th>
                                                                            <td>{{ $emp->dob }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Blood Group</th>
                                                                            <td>{{ $emp->blood }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Gender</th>
                                                                            <td>{{ $emp->gender }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Marital Status</th>
                                                                            <td>{{ $emp->marital }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Spouse Name</th>
                                                                            <td>{{ $emp->spouse }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Name</th>
                                                                            <td>{{ $emp->father }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Occupation</th>
                                                                            <td>{{ $emp->foccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Name</th>
                                                                            <td>{{ $emp->mother }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Occupation</th>
                                                                            <td>{{ $emp->moccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Name</th>
                                                                            <td>{{ $emp->emername }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Number</th>
                                                                            <td>{{ $emp->emernumber }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-office{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-office-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Username</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Date of Joining</th>
                                                                            <td>{{ $emp->joined_on }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Shift</th>
                                                                            <td>{{ $emp->shift }}</td>
                                                                        </tr>
                                                                        @if ($emp->shift == 'IN')
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>12:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>09:00 PM</td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>07:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>04:00 AM</td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <th>Status</th>
                                                                            <td>{{ $emp->emp_status }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-department{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-department-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Department</th>
                                                                            <td>{{ $emp->department }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Designation</th>
                                                                            <td>{{ $emp->designation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Manager</th>
                                                                            <td>{{ $emp->manager }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-qualification{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-qualification-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Qualification</th>
                                                                            <td>{{ $emp->qualification }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Education</th>
                                                                            <td>{{ $emp->education }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-address{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-address-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <h4>Permanent Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->perm_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->perm_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->perm_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->perm_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->perm_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                    <h4 class="mt-5">Temporary Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->temp_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->temp_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->temp_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->temp_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->temp_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-bank{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-bank-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>PAN</th>
                                                                            <td>{{ $emp->pancard }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Aadhaar</th>
                                                                            <td>{{ $emp->aadhaar }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>UAN</th>
                                                                            <td>{{ $emp->uan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Name</th>
                                                                            <td>{{ $emp->bank_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Acc Number</th>
                                                                            <td>{{ $emp->acc_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Branch</th>
                                                                            <td>{{ $emp->bank_branch }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>IFSC</th>
                                                                            <td>{{ $emp->ifsc }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane fade" id="nav-document{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-document-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-docements',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download',$emp->documents_2) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>




                                                            <div class="tab-pane fade" id="nav-resume{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-resume-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-resume',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download-resume',$emp->resume) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>
    

                                                           
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white"
                                                            data-coreui-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       @if(Auth::user()->status == 0)
                                        <a href="/edit-employee/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-secondary m-2">Edit</a>
                                        @endif
                                        <a href="/edit-payroll/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-dark m-2">Salary Details</a>
                                        <a href="/hike/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-warning m-2">Hike</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body table-responsive notice" style="display:none;">
                <table id="example2" class="table table-striped table-bordered" style="width:100%"
                    data-order="[[ 1, &quot;asc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>contact</th>
                            <th>email</th>
                            <th>DOB</th>
                            <th>gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeesnotice as $emp)
                            <tr>
                                <td>{{ $emp->empcode }}</td>
                                <td>{{ $emp->fname }}</td>
                                <td>{{ $emp->lname }}</td>
                                <td>{{ $emp->emp_status }}</td>
                                <td>{{ $emp->contact }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->dob }}</td>
                                <td>{{ $emp->gender }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" data-coreui-toggle="modal"
                                            data-coreui-target="#showEmployee{{ $emp->id }}"
                                            class="btn btn-sm btn-primary m-2">Show</a>
                                        <div class="modal fade" id="showEmployee{{ $emp->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details of
                                                            {{ $emp->fname }} {{ $emp->lname }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <button class="nav-link active fw-bold"
                                                                    id="nav-profile-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-profile{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-profile{{ $emp->id }}"
                                                                    aria-selected="true">Profile</button>
                                                                <button class="nav-link fw-bold" id="nav-office-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-office{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-office{{ $emp->id }}"
                                                                    aria-selected="false">Office</button>
                                                                <button class="nav-link fw-bold" id="nav-department-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-department{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-department{{ $emp->id }}"
                                                                    aria-selected="false">Department</button>
                                                                <button class="nav-link fw-bold"
                                                                    id="nav-qualification-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-qualification{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-qualification{{ $emp->id }}"
                                                                    aria-selected="false">Qualification</button>
                                                                <button class="nav-link fw-bold" id="nav-address-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-address{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-address{{ $emp->id }}"
                                                                    aria-selected="false">Address</button>
                                                                <button class="nav-link fw-bold" id="nav-bank-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-bank{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-bank{{ $emp->id }}"
                                                                    aria-selected="false">Bank</button>


                                                                    <button class="nav-link fw-bold" id="nav-document-tab{{ $emp->id }}"
                                                                        data-coreui-toggle="tab"
                                                                        data-coreui-target="#nav-document{{ $emp->id }}" type="button"
                                                                        role="tab" aria-controls="nav-document{{ $emp->id }}"
                                                                        aria-selected="false">Document</button>
    
                                                                        <button class="nav-link fw-bold" id="nav-resume-tab{{ $emp->id }}"
                                                                            data-coreui-toggle="tab"
                                                                            data-coreui-target="#nav-resume{{ $emp->id }}" type="button"
                                                                            role="tab" aria-controls="nav-resume{{ $emp->id }}"
                                                                            aria-selected="false">Resume</button>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" id="nav-tabContent">
                                                            <div class="tab-pane fade show active" id="nav-profile{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-profile-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <td>{{ $emp->fname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Middle Name</th>
                                                                            <td>{{ $emp->mname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Last Name</th>
                                                                            <td>{{ $emp->lname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Contact Number</th>
                                                                            <td>{{ $emp->contact }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email ID</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>DOB</th>
                                                                            <td>{{ $emp->dob }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Blood Group</th>
                                                                            <td>{{ $emp->blood }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Gender</th>
                                                                            <td>{{ $emp->gender }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Marital Status</th>
                                                                            <td>{{ $emp->marital }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Spouse Name</th>
                                                                            <td>{{ $emp->spouse }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Name</th>
                                                                            <td>{{ $emp->father }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Occupation</th>
                                                                            <td>{{ $emp->foccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Name</th>
                                                                            <td>{{ $emp->mother }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Occupation</th>
                                                                            <td>{{ $emp->moccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Name</th>
                                                                            <td>{{ $emp->emername }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Number</th>
                                                                            <td>{{ $emp->emernumber }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-office{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-office-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Username</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Date of Joining</th>
                                                                            <td>{{ $emp->joined_on }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Shift</th>
                                                                            <td>{{ $emp->shift }}</td>
                                                                        </tr>
                                                                        @if ($emp->shift == 'IN')
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>12:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>09:00 PM</td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>07:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>04:00 AM</td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <th>Status</th>
                                                                            <td>{{ $emp->emp_status }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-department{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-department-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Department</th>
                                                                            <td>{{ $emp->department }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Designation</th>
                                                                            <td>{{ $emp->designation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Manager</th>
                                                                            <td>{{ $emp->manager }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-qualification{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-qualification-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Qualification</th>
                                                                            <td>{{ $emp->qualification }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Education</th>
                                                                            <td>{{ $emp->education }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-address{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-address-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <h4>Permanent Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->perm_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->perm_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->perm_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->perm_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->perm_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                    <h4 class="mt-5">Temporary Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->temp_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->temp_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->temp_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->temp_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->temp_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-bank{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-bank-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>PAN</th>
                                                                            <td>{{ $emp->pancard }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Aadhaar</th>
                                                                            <td>{{ $emp->aadhaar }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>UAN</th>
                                                                            <td>{{ $emp->uan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Name</th>
                                                                            <td>{{ $emp->bank_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Acc Number</th>
                                                                            <td>{{ $emp->acc_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Branch</th>
                                                                            <td>{{ $emp->bank_branch }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>IFSC</th>
                                                                            <td>{{ $emp->ifsc }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>


                                                            <div class="tab-pane fade" id="nav-document{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-document-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-docements',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download',$emp->documents_2) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>




                                                            <div class="tab-pane fade" id="nav-resume{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-resume-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-resume',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download-resume',$emp->resume) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white"
                                                            data-coreui-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       @if(Auth::user()->status == 0)
                                        <a href="/edit-employee/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-secondary m-2">Edit</a>
                                        @endif
                                        <a href="/edit-payroll/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-dark m-2">Salary Details</a>
                                        <a href="/hike/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-warning m-2">Hike</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body table-responsive resigned" style="display:none;">
                <table id="example3" class="table table-striped table-bordered" style="width:100%"
                    data-order="[[ 1, &quot;asc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>Date of Resignation</th>
                            <th>contact</th>
                            <th>email</th>
                            <th>DOB</th>
                            <th>gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeesresigned as $emp)
                            <tr>
                                <td>{{ $emp->empcode }}</td>
                                <td>{{ $emp->fname }}</td>
                                <td>{{ $emp->lname }}</td>
                                <td>{{ $emp->emp_status }}</td>
                                <td>{{ $emp->resigned_on }}</td>
                                <td>{{ $emp->contact }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->dob }}</td>
                                <td>{{ $emp->gender }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" data-coreui-toggle="modal"
                                            data-coreui-target="#showEmployee{{ $emp->id }}"
                                            class="btn btn-sm btn-primary m-2">Show</a>
                                        <div class="modal fade" id="showEmployee{{ $emp->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details of
                                                            {{ $emp->fname }} {{ $emp->lname }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <nav>
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <button class="nav-link active fw-bold"
                                                                    id="nav-profile-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-profile{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-profile{{ $emp->id }}"
                                                                    aria-selected="true">Profile</button>
                                                                <button class="nav-link fw-bold" id="nav-office-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-office{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-office{{ $emp->id }}"
                                                                    aria-selected="false">Office</button>
                                                                <button class="nav-link fw-bold" id="nav-department-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-department{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-department{{ $emp->id }}"
                                                                    aria-selected="false">Department</button>
                                                                <button class="nav-link fw-bold"
                                                                    id="nav-qualification-tab{{ $emp->id }}" data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-qualification{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-qualification{{ $emp->id }}"
                                                                    aria-selected="false">Qualification</button>
                                                                <button class="nav-link fw-bold" id="nav-address-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-address{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-address{{ $emp->id }}"
                                                                    aria-selected="false">Address</button>
                                                                <button class="nav-link fw-bold" id="nav-bank-tab{{ $emp->id }}"
                                                                    data-coreui-toggle="tab"
                                                                    data-coreui-target="#nav-bank{{ $emp->id }}" type="button"
                                                                    role="tab" aria-controls="nav-bank{{ $emp->id }}"
                                                                    aria-selected="false">Bank</button>


                                                                    <button class="nav-link fw-bold" id="nav-document-tab{{ $emp->id }}"
                                                                        data-coreui-toggle="tab"
                                                                        data-coreui-target="#nav-document{{ $emp->id }}" type="button"
                                                                        role="tab" aria-controls="nav-document{{ $emp->id }}"
                                                                        aria-selected="false">Document</button>
    
                                                                        <button class="nav-link fw-bold" id="nav-resume-tab{{ $emp->id }}"
                                                                            data-coreui-toggle="tab"
                                                                            data-coreui-target="#nav-resume{{ $emp->id }}" type="button"
                                                                            role="tab" aria-controls="nav-resume{{ $emp->id }}"
                                                                            aria-selected="false">Resume</button>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" id="nav-tabContent">
                                                            <div class="tab-pane fade show active" id="nav-profile{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-profile-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <td>{{ $emp->fname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Middle Name</th>
                                                                            <td>{{ $emp->mname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Last Name</th>
                                                                            <td>{{ $emp->lname }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Contact Number</th>
                                                                            <td>{{ $emp->contact }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email ID</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>DOB</th>
                                                                            <td>{{ $emp->dob }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Blood Group</th>
                                                                            <td>{{ $emp->blood }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Gender</th>
                                                                            <td>{{ $emp->gender }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Marital Status</th>
                                                                            <td>{{ $emp->marital }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Spouse Name</th>
                                                                            <td>{{ $emp->spouse }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Name</th>
                                                                            <td>{{ $emp->father }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Father Occupation</th>
                                                                            <td>{{ $emp->foccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Name</th>
                                                                            <td>{{ $emp->mother }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Mother Occupation</th>
                                                                            <td>{{ $emp->moccupation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Name</th>
                                                                            <td>{{ $emp->emername }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Emergency Contact Number</th>
                                                                            <td>{{ $emp->emernumber }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-office{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-office-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Username</th>
                                                                            <td>{{ $emp->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Date of Joining</th>
                                                                            <td>{{ $emp->joined_on }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Shift</th>
                                                                            <td>{{ $emp->shift }}</td>
                                                                        </tr>
                                                                        @if ($emp->shift == 'IN')
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>12:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>09:00 PM</td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <th>Login Time</th>
                                                                                <td>07:00 PM</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Logout Time</th>
                                                                                <td>04:00 AM</td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <th>Status</th>
                                                                            <td>{{ $emp->emp_status }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-department{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-department-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Employee Code</th>
                                                                            <td>{{ $emp->empcode }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Department</th>
                                                                            <td>{{ $emp->department }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Designation</th>
                                                                            <td>{{ $emp->designation }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Manager</th>
                                                                            <td>{{ $emp->manager }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-qualification{{ $emp->id }}"
                                                                role="tabpanel" aria-labelledby="nav-qualification-tab{{ $emp->id }}"
                                                                tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Qualification</th>
                                                                            <td>{{ $emp->qualification }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Education</th>
                                                                            <td>{{ $emp->education }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-address{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-address-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <h4>Permanent Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->perm_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->perm_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->perm_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->perm_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->perm_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                    <h4 class="mt-5">Temporary Address</h4>
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Address Line 1</th>
                                                                            <td>{{ $emp->temp_address_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Address Line 2</th>
                                                                            <td>{{ $emp->temp_address_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>City</th>
                                                                            <td>{{ $emp->temp_city }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>State</th>
                                                                            <td>{{ $emp->temp_state }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pincode</th>
                                                                            <td>{{ $emp->temp_pincode }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="nav-bank{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-bank-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>PAN</th>
                                                                            <td>{{ $emp->pancard }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Aadhaar</th>
                                                                            <td>{{ $emp->aadhaar }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>UAN</th>
                                                                            <td>{{ $emp->uan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Name</th>
                                                                            <td>{{ $emp->bank_name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Acc Number</th>
                                                                            <td>{{ $emp->acc_number }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Bank Branch</th>
                                                                            <td>{{ $emp->bank_branch }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>IFSC</th>
                                                                            <td>{{ $emp->ifsc }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>



                                                            <div class="tab-pane fade" id="nav-document{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-document-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-docements',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download',$emp->documents_2) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>




                                                            <div class="tab-pane fade" id="nav-resume{{ $emp->id }}" role="tabpanel"
                                                                aria-labelledby="nav-resume-tab{{ $emp->id }}" tabindex="0">
                                                                <div class="w-100 mt-5">
                                                                    <table
                                                                        class="w-100 table table-striped table-bordered">
                                                                        <tr>
                                                                            <th>Document</th>
                                                                            <td><a href="{{ url('/view-resume',$emp->id) }}" class="btn btn-success">View</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Download Document</th>
                                                                            <td><a href="{{ url('/download-resume',$emp->resume) }}" class="btn btn-secondary">Download</a></td>
                                                                        </tr>
                                                                       
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white"
                                                            data-coreui-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       @if(Auth::user()->status == 0)
                                        <a href="/edit-employee/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-secondary m-2">Edit</a>
                                        @endif
                                        <a href="/edit-payroll/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-dark m-2">Salary Details</a>
                                        <a href="/hike/{{ encrypt($emp->id) }}"
                                            class="btn btn-sm btn-warning m-2">Hike</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script4')

<script>
    //  let open = document.querySelector('#open1')
    // open.addEventListener('click',function(e){
    //     console.log("Hello");
        
        
    // })
    // console.log("hello")
    // console.log('Hello')
</script>

@endpush

@push('scripts')
<script>
    function openAddDocModal(id){
        let doc_add_modal = document.querySelector('#addDocModal');
        doc_add_modal.style.display="block";
    }

    // let open = document.querySelector('.open')
    // open.addEventListener('click',function(e){
    //     console.log(open);
        
        
    // })

</script>

@endpush

@push('scripts')
<script>
    

   

</script>
@endpush


@push('scripts')
<script>
    // function closeModal(id){
    //     let doc_add_modal = document.querySelector('#addDocModal');
    //     doc_add_modal.style.display="none";

    // }
    let close = document.querySelector('#clsModal');
    close.addEventListener('click',function(e){
        close.style.display="none";
        e.stopPropagation();

    });
</script>

@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
            $('#example1').DataTable({
                responsive: true
            });
            $('#example2').DataTable({
                responsive: true
            });
            $('#example3').DataTable({
                responsive: true
            });
            $('#problem').on('change', function(){

                
            if (this.value) {
               if (this.value == 'Permanent') {
            
                  $('.permanent').show();
                  $('.training').hide();
                  $('.notice').hide();
                  $('.resigned').hide();
               }
            
               if (this.value == 'Training') {
                  $('.permanent').hide();
                  $('.training').show();
                  $('.notice').hide();
                  $('.resigned').hide();
               }   
               if (this.value == 'Notice') {
                  $('.permanent').hide();
                  $('.training').hide();
                  $('.notice').show();
                  $('.resigned').hide();
               }  
               if (this.value == 'Resigned') {
                  $('.permanent').hide();
                  $('.training').hide();
                  $('.notice').hide();
                  $('.resigned').show();
               }  
              }
            });
        });
    </script>
@endpush


@push('scripts')
    <script>
        let toastBox = document.getElementByClass('errorMsg');
        // errorMsg

        let errorMsg = 'Username is Already Exists';

        function showToast(msg){
            let toast = document.createElement('div');
            toast.classList.add('toast');
            toast.innerHTML = msg;
            toastBox.appendChild(toast);
        }
    
    </script>
@endpush
