<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerPhoneContact;
use App\Models\Document;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class CustomerController extends Controller
{
     public function index(Request $request){
         $customers=Customer::where(function($customers) use($request){
             $customers->where('name','LIKE','%'.$request->search.'%')
                 ->orWhere('mobile','LIKE','%'.$request->search.'%')
                 ->orWhere('email','LIKE','%'.$request->search.'%');
         });

         if($request->fromdate)
             $customers=$customers->where('created_at', '>=', $request->fromdate.'00:00:00');

         if($request->todate)
             $customers=$customers->where('created_at', '<=', $request->todate.'23:59:50');

         if($request->status)
             $customers=$customers->where('status', $request->status);

         if($request->ordertype)
             $customers=$customers->orderBy('created_at', $request->ordertype);

         $customers=$customers->paginate(10);
         return view('admin.customer.view',['customers'=>$customers]);
            return view('admin.customer.view',['customers'=>$customers]);
              }

    public function edit(Request $request,$id){
             $customers = Customer::findOrFail($id);
             return view('admin.customer.edit',['customers'=>$customers]);
             }

    public function update(Request $request,$id){
             $request->validate([
                             'status'=>'required',
                  			'name'=>'required',
                  			'dob'=>'required',
                  			'address'=>'required',
                  			'city'=>'required',
                  			'state'=>'required',
                  			'image'=>'image'
                  			]);

             $customers = Customer::findOrFail($id);
          if($request->image){
			 $customers->update([
                      'status'=>$request->status,
                      'name'=>$request->name,
                      'email'=>$request->email,
                      'dob'=>$request->dob,
                      'address'=>$request->address,
                      'city'=>$request->city,
                      'state'=>$request->state,
                      'image'=>'a']);
             $customers->saveImage($request->image, 'customers');
        }else{
             $customers->update([
                      'status'=>$request->status,
                      'name'=>$request->name,
                        'email'=>$request->email,
                        'dob'=>$request->dob,
                      'address'=>$request->address,
                      'city'=>$request->city,
                      'state'=>$request->state
                         ]);
             }
          if($customers)
             {
           return redirect()->back()->with('success', 'Customer has been updated');
              }
           return redirect()->back()->with('error', 'Customer update failed');

      }

      function send_message(Request $request)
        {

        $cusid=$request->cusid;
        $title=$request->title;
        $des=$request->des;
        $Notification=Notification::create([
                      'title'=>$title,
                      'description'=>$des,
                      'user_id'=>$cusid,
                      'type'=>'individual'
                      ]);
         if($Notification){
           return response()->json(['users' => $Notification], 200);
       }else{
              return response()->json(['msg' => 'No result found!'], 404);
       }

        }


        public function uploadDocuments(Request $request, $id){

            $customer=Customer::findOrFail($id);

            $request->validate([
                'pancard'=>'mimes:jpeg,bmp,png,gif,svg,pdf,webp',
                'adhaarfront'=>'mimes:jpeg,bmp,png,gif,svg,pdf,webp',
                'adhaarback'=>'mimes:jpeg,bmp,png,gif,svg,pdf,webp',
                'incomedoc.*'=>'mimes:jpeg,bmp,png,gif,svg,pdf,webp',
                'addressdoc.*'=>'mimes:jpeg,bmp,png,gif,svg,pdf,webp',
            ]);

            if($request->pancard){
                Document::where('document_name', 'Pancard')->where('entity_id', $customer->id)->delete();
                $customer->saveDocument($request->pancard, 'user-docs', ['name'=>'Pancard']);
            }

            if($request->adhaarfront){
                Document::where('document_name', 'Adhaar Front')->where('entity_id', $customer->id)->delete();
                $customer->saveDocument($request->adhaarfront, 'user-docs', ['name'=>'Adhaar Front']);
            }

            if($request->adhaarback){
                Document::where('document_name', 'Adhaar Back')->where('entity_id', $customer->id)->delete();
                $customer->saveDocument($request->adhaarback, 'user-docs', ['name'=>'Adhaar Back']);
            }

            if($request->incomedoc){
                foreach($request->incomedoc as $file){
                    $customer->saveDocument($file, 'user-docs', ['name'=>'Income Document']);
                }
            }

            if($request->addressdoc){
                foreach($request->incomedoc as $file){
                    $customer->saveDocument($file, 'user-docs', ['name'=>'Address Document']);
                }
            }

            return redirect()->back()->with('success', 'Documents have been updated');

        }


        public function downloadZip(Request $request, $id){
            $zip_file = storage_path('app/temp/'.$id.'_documents.zip');//die;
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $path = storage_path('app/documents/user-docs/'.$id);
            if(file_exists($path)){
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
                foreach ($files as $name => $file)
                {
                    // We're skipping all subfolders
                    if (!$file->isDir()) {
                        $filePath     = $file->getRealPath();

                        // extracting filename with substr/strlen
                        $relativePath = substr($filePath, strlen($path) + 1);

                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                return response()->download($zip_file);
            }

            return redirect()->back()->with('error', 'No documents attached');

        }


        public function contacts(Request $request, $id){
            $contacts=CustomerPhoneContact::where('user_id', $id)->get();

            return view('admin.customer.contacts', compact('contacts'));
        }

  }
