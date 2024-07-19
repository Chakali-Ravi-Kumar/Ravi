<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal_table;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Hike;
use Auth;
use Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File as FacadesFile;
// use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class companyController extends Controller
{
    function employees($companyName)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $employees = personal_table::select('companies.name', 'personal_tables.*', 'users.empcode')
            ->join('companies', 'companies.id', 'personal_tables.company_id')
            ->join('users', 'users.id', 'personal_tables.user_id')
            ->where('companies.name', $companyName)
            ->select('personal_tables.*','companies.name as name','users.emp_status','users.shift','users.empcode')
            ->where('users.emp_status', 'Permanent')
            ->get();
        $employeestraining = personal_table::select('companies.name', 'personal_tables.*', 'users.empcode')
            ->join('companies', 'companies.id', 'personal_tables.company_id')
            ->join('users', 'users.id', 'personal_tables.user_id')
            ->where('companies.name', $companyName)
            ->select('personal_tables.*','companies.name as name','users.emp_status','users.shift','users.empcode')
            ->where('users.emp_status', 'Training')
            ->get();
        $employeesnotice = personal_table::select('companies.name', 'personal_tables.*', 'users.empcode')
            ->join('companies', 'companies.id', 'personal_tables.company_id')
            ->join('users', 'users.id', 'personal_tables.user_id')
            ->where('companies.name', $companyName)
            ->select('personal_tables.*','companies.name as name','users.emp_status','users.shift','users.empcode')
            ->where('users.emp_status', 'Notice')
            ->get();
        $employeesresigned = personal_table::select('companies.name', 'personal_tables.*', 'users.empcode')
            ->join('companies', 'companies.id', 'personal_tables.company_id')
            ->join('users', 'users.id', 'personal_tables.user_id')
            ->where('companies.name', $companyName)
            ->select('personal_tables.*','companies.name as name','users.emp_status','users.shift','users.empcode')
            ->where('users.emp_status', 'Resigned')
            ->get();
        return view('pages.companyEmployees', ['employees' => $employees, 'employeestraining' => $employeestraining, 'employeesnotice' => $employeesnotice, 'employeesresigned' => $employeesresigned, 'users' => $users]);
    }

    public function add()
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        return view('pages.add', ['users' => $users]);
    }

    public function addDetails(Request $request)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = new personal_table();
        $personal_table->user_id = $request->user_id;
        $personal_table->company_id = Auth::user()->company_id;
        $personal_table->fname = $request->fname;
        $personal_table->mname = $request->mname;
        $personal_table->lname = $request->lname;
        $personal_table->email = $request->email;
        $personal_table->contact = $request->contact;
        $personal_table->dob = $request->dob;
        $personal_table->blood = $request->blood;
        $personal_table->gender = $request->gender;
        $personal_table->marital = $request->marital;
        $personal_table->spouse = $request->spouse;
        $personal_table->father = $request->father;
        $personal_table->mother = $request->mother;
        $personal_table->foccupation = $request->foccupation;
        $personal_table->moccupation = $request->moccupation;
        $personal_table->emername = $request->emername;
        $personal_table->emernumber = $request->emernumber;
        $personal_table->pemail = $request->pemail;
        $personal_table->passport = $request->passport;
        $personal_table->temp_address_1 = $request->temp_address_1;
        $personal_table->temp_address_2 = $request->temp_address_2;
        $personal_table->temp_city = $request->temp_city;
        $personal_table->temp_state = $request->temp_state;
        $personal_table->temp_pincode = $request->temp_pincode;
        $personal_table->perm_address_1 = $request->perm_address_1;
        $personal_table->perm_address_2 = $request->perm_address_2;
        $personal_table->perm_city = $request->perm_city;
        $personal_table->perm_state = $request->perm_state;
        $personal_table->perm_pincode = $request->perm_pincode;
        $personal_table->qualification = $request->qualification;
        $personal_table->education = $request->education;
        $personal_table->pancard = $request->pancard;
        $personal_table->aadhaar = $request->aadhaar;
        $personal_table->uan = "NA";
        $personal_table->bank_name = $request->bank_name;
        $personal_table->bank_branch = $request->bank_branch;
        $personal_table->acc_number = $request->acc_number;
        $personal_table->ifsc = $request->ifsc;
        $personal_table->save();

        $payroll = new Payroll;
        $payroll->user_id = Auth::user()->id;
        $payroll->save();

        $hike = new Hike;
        $hike->user_id = Auth::user()->id;
        $hike->save();

        $stat = User::find(Auth::user()->id);
        $stat->add_status = 1;
        $stat->notification = 1;
        $stat->save();

        Alert::toast('Details Added Successfully', 'success');
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $employee = personal_table::join('users', 'users.id', 'personal_tables.user_id')
            ->where('personal_tables.id', Crypt::decrypt($id))
            ->select('personal_tables.*', 'users.empcode', 'users.ctc', 'users.status')
            ->get()
            ->first();
        return view('pages.edit', ['employee' => $employee, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = personal_table::find($id);
        $personal_table->joined_on = $request->joined_on;
        $personal_table->resigned_on = $request->resigned_on;
        $personal_table->confirmation = $request->confirmation;
        $personal_table->emp_status = $request->empstatus;
        $personal_table->fname = $request->fname;
        $personal_table->mname = $request->mname;
        $personal_table->lname = $request->lname;
        $personal_table->email = $request->email;
        $personal_table->contact = $request->contact;
        $personal_table->dob = $request->dob;
        $personal_table->blood = $request->blood;
        $personal_table->gender = $request->gender;
        $personal_table->marital = $request->marital;
        $personal_table->spouse = $request->spouse;
        $personal_table->father = $request->father;
        $personal_table->mother = $request->mother;
        $personal_table->foccupation = $request->foccupation;
        $personal_table->moccupation = $request->moccupation;
        $personal_table->emername = $request->emername;
        $personal_table->emernumber = $request->emernumber;
        $personal_table->pemail = $request->pemail;
        $personal_table->passport = $request->passport;
        $personal_table->temp_address_1 = $request->temp_address_1;
        $personal_table->temp_address_2 = $request->temp_address_2;
        $personal_table->temp_city = $request->temp_city;
        $personal_table->temp_state = $request->temp_state;
        $personal_table->temp_pincode = $request->temp_pincode;
        $personal_table->perm_address_1 = $request->perm_address_1;
        $personal_table->perm_address_2 = $request->perm_address_2;
        $personal_table->perm_city = $request->perm_city;
        $personal_table->perm_state = $request->perm_state;
        $personal_table->perm_pincode = $request->perm_pincode;
        $personal_table->qualification = $request->qualification;
        $personal_table->education = $request->education;
        $personal_table->yop = $request->yop;
        $personal_table->pancard = $request->pancard;
        $personal_table->aadhaar = $request->aadhaar;
        $personal_table->uan = $request->uan;
        $personal_table->bank_name = $request->bank_name;
        $personal_table->bank_branch = $request->bank_branch;
        $personal_table->acc_number = $request->acc_number;
        $personal_table->ifsc = $request->ifsc;
        $personal_table->department = $request->department;
        $personal_table->designation = $request->designation;
        $personal_table->manager = $request->manager;
        $personal_table->pf_no = $request->pf_no;
        $personal_table->esic_no = $request->esic_no;
        $personal_table->documents = $request->documents;

   
        $file = $request->documents_2;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $request->documents_2->move('assets/documents',$filename);
        $personal_table->documents_2 = $filename;
        $personal_table->save();
   

       
        // $resume = $request->resume;
        // $filename_2 = time().'.'.$resume->getClientOriginalExtension();
        // $request->resume->move('assets/resume',$filename_2);
        // $personal_table->resume = $filename_2;
        // $personal_table->save();
         





        // $personal_table->documents = $request->documents_2;
        // if($request->has('documents_2')){
        //     $file = $request->file('documents_2');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$extension;
        //     $path = 'UploadedDocuments/';
        //     $file->move($path,$filename);
        //     $personal_table->documents_2 = $path.$filename;
        //     if(File::exists($personal_table->documents_2)){
        //         File::delete($personal_table->documents_2);
        //     }
        //     $personal_table->documents_2 = $path.$filename;
        // }else{
        //     $personal_table->documents_2 = "null";
        // }
        // $personal_table->save();



        $empcode = User::find($personal_table->user_id);
        $empcode->empcode = $request->empcode;
        $empcode->status = $request->empposition;
        $empcode->emp_status = $request->empstatus;
        $empcode->ctc = $request->ctc;
        $empcode->notification = 0;
        $empcode->save();

        Alert::toast('Details Updated Successfully', 'success');
        return redirect()->back();
        // return redirect()->route('update.employee');
    }



    public function viewDocuments($id){
        $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = personal_table::find($id);
        return view('pages.view-documents',compact('personal_table'));
    }



// add documents
public function addDocuments($id){
    $users = User::where('id', Auth::user()->id)
            ->get()
            ->first();
        $personal_table = personal_table::find($id);
        return view('pages.add-documents',compact('personal_table'));
}


    public function viewResume($id){
        $users = User::where('id', Auth::user()->id)
        ->get()
        ->first();
        $personal_table = personal_table::find($id);
        return view('pages.view-resume',compact('personal_table'));

    }

    public function download(Request $req, $file){
        return response()->download(public_path('assets/documents/'.$file));
    }

    public function downloadResume(Request $req, $file){
        return response()->download(public_path('assets/resume/'.$file));
    }



        // $resume = $request->resume;
        // $filename_2 = time().'.'.$resume->getClientOriginalExtension();
        // $request->resume->move('assets/resume',$filename_2);
        // $personal_table->resume = $filename_2;
        // $personal_table->save();

    public function addMultipleDocs(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
        ]);

        if($request->hasfile('files'))
        {
            $fileModel = new personal_table();
            foreach($request->file('files') as $file)
            {
                $name = time().'_'.$file->getClientOriginalExtension();
                $filePath = $file->move('assets/resume',$name);

                // $fileModel = new personal_table();
                $fileModel->documents_2 = $filePath;
                // $fileModel->file_name = time().'_'.$file->getClientOriginalName();
                // $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
            }
        }

        Alert::toast('Documents Uploaded Successfully', 'success');
        return redirect()->back();
        // return back()->with('success', 'Files uploaded successfully');
    }
    // public function addMultipleDocs($id){
    //     $users = User::where('id', Auth::user()->id)
    //     ->get()
    //     ->first();
    //     $personal_table = personal_table::find($id);




    
    // $file = $request->documents_2;
    // $filename = time().'.'.$file->getClientOriginalExtension();
    // $request->documents_2->move('assets/documents',$filename);
    // $personal_table->documents_2 = $filename;
    // $personal_table->save();


    // }


    public function uploadDocuments(Request $req,$id){
        $imagesData = [];
        $personal_table = personal_table::find($id);
        if($files = $req->file('images')){
            foreach($files as $key => $file){
                $extension = $file->getClientOriginalExtension();
                $filename = $key.'.'.time().'.'.$extension;
                $path = "assets/documents/";
                $file->move($path,$filename);
                $imagesData[] = [
                    'documents_2' => $path.$filename
                ];
            }
        }
        // personal_table::insert($imagesData);

        $personal_table->documents_2 = $imagesData;

        Alert::toast('Documents Uploaded Successfully', 'success');
        return redirect()->route('employees');

    }


}
