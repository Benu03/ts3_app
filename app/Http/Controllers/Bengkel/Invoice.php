<?php

namespace App\Http\Controllers\Bengkel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Konfigurasi_model;
use Image;
use PDF;
use Log;

class Invoice extends Controller
{




    public function index()
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
    
        
        $count_req = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('create_by',Session()->get('username'))->where('status','REQUEST')->count();
        $count_pro = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('create_by',Session()->get('username'))->where('status','PROSES')->count();
        $invoice = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('create_by',Session()->get('username'))->whereIn('status',['PROSES','REQUEST'])->get();
		$data = array(   'title'        => 'Invoice',
                         'invoice'      => $invoice,
                         'count_req'    => $count_req,
                         'count_pro'    => $count_pro,
                        'content'       => 'bengkel/invoice/index'
                    );
        return view('bengkel/layout/wrapper',$data);
    }

    public function summary_bengkel()
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
    
        $nopol = DB::connection('ts3')->table('mst.v_vehicle')->get();

		$data = array(   'title'     => 'Summary Bengkel',
                         'nopol'      => $nopol,
                        'content'   => 'bengkel/invoice/summary_bengkel'
                    );
        return view('bengkel/layout/wrapper',$data);
    }

    public function invoice_create()
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $usebengkel = DB::connection('ts3')->table('mst.mst_bengkel')->where('pic_bengkel',Session()->get('username'))->first();
        $serviceinvoice = DB::connection('ts3')->table('mvm.v_service_bengkel')->where('mst_bengkel_id',$usebengkel->id)->get();
      
        $regional_id = [];
        $client_id = [];

        foreach($serviceinvoice  as $key => $val){
            $regional_id[] = $val->mst_regional_id;
            $client_id[] =  $val->mst_client_id;
        }


        $priceJobs  = DB::connection('ts3')->table('mst.v_price_regional_client')
                    ->select('kode', 'service_name','price_bengkel_to_ts3','price_ts3_to_client')
                    ->wherein('mst_client_id',$client_id)
                    ->wherein('mst_regional_id',$regional_id)
                    ->where('price_service_type','Jasa')
                    ->groupBy('kode', 'service_name','price_bengkel_to_ts3','price_ts3_to_client')
                    ->get();

        $pricePart = DB::connection('ts3')->table('mst.v_price_regional_client')
                    ->select('kode', 'service_name','price_bengkel_to_ts3','price_ts3_to_client')
                    ->wherein('mst_client_id',$client_id)
                    ->wherein('mst_regional_id',$regional_id)
                    ->where('price_service_type','Part')
                    ->groupBy('kode', 'service_name','price_bengkel_to_ts3','price_ts3_to_client')
                    ->get();            

 
        $checkInvoice = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('status','DRAFT')->where('create_by',Session()->get('username'))->first();
    
        if(isset($checkInvoice) == false){
            $invoice_no   = 'INV-'.date("Ymd").'-'.date("is"); 
        }
        else{
            $invoice_no = $checkInvoice->invoice_no;
        }

        $invoicedtl = DB::connection('ts3')->table('mvm.v_invoice_detail_prepare')->where('invoice_no',$invoice_no)->get(); 
   

        $invoiceData = DB::connection('ts3')->table('mvm.v_invoice_detail_prepare')->selectRaw("(sum(jasa) * 2) / 100 as pph,sum(jasa) as jasa,sum(part) as part")->where('invoice_no',$invoice_no)->first(); 
      
        $service_invoice = DB::connection('ts3')->table('mvm.v_service_bengkel_invoice')->where('mst_bengkel_id',$usebengkel->id)->get(); 
 

        $data = array(   'title'        => 'Invoice',
                         'usebengkel'      => $usebengkel,
                         'serviceinvoice'    => $serviceinvoice,
                         'priceJobs'    => $priceJobs,
                         'pricePart'    => $pricePart,
                         'invoicedtl'    => $invoicedtl,
                         'invoice_no'    => $invoice_no,
                         'invoiceData'    => $invoiceData,
                         'service_invoice'    => $service_invoice,
                        'content'       => 'bengkel/invoice/invoice_create'
                    );
        return view('bengkel/layout/wrapper',$data);

    }

    public function invoice_create_detail(Request $request)
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // request()->validate([
        //     'service_no' => 'required',
            
        //     ]);
     
        if($request->id == null)
        {
            return redirect('bengkel/invoice-create')->with(['warning' => 'Service Belum ada Yang di Pilih']);
        }
 
        $checkInvoice = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$request->invoice_no)->get();
        if(count($checkInvoice) == 0)
        {
        try{
            DB::beginTransaction();
            $service_id =   DB::connection('ts3')->table('mvm.mvm_invoice_h')->insertgetID([
                'invoice_no'   => $request->invoice_no,
                'invoice_type'	=> 'BENGKEL TO TS3',
                'status'	=> 'DRAFT',
                'created_date'    => date("Y-m-d h:i:sa"),
                'create_by'     => $request->session()->get('username'),
            ]); 

            foreach($request->id as $serno){
                $service_jasa = DB::connection('ts3')->table('mvm.v_service_detail_invoice_bengkel')->where('service_no',$serno)->where('detail_type','Pekerjaan')->get(); 
               
                $service_part = DB::connection('ts3')->table('mvm.v_service_detail_invoice_bengkel')->where('service_no',$serno)->where('detail_type','Spare Part')->get(); 
                
            
                                                            foreach($service_jasa as $val){
                                                                $price = DB::connection('ts3')->table('mst.mst_price_service')->where('id',intval($val->unique_data))->first();

                                                                $datajobs = [
                                                                    'mvm_invoice_h_id' => $service_id,
                                                                    'service_no' => $serno,
                                                                    'created_date'    => date("Y-m-d h:i:sa"),
                                                                    'create_by'     => $request->session()->get('username'),
                                                                    'mst_price_service_id' => $price->kode,
                                                                    'price_bengkel_to_ts3' => $price->price_bengkel_to_ts3,
                                                                    'invoice_no' => $request->invoice_no,
                                                                    'price_type' => $price->price_service_type,
                                                                    'price_ts3_to_client' => $price->price_ts3_to_client,
                                                                ];

                                                                DB::connection('ts3')->table('mvm.mvm_invoice_d')->insert($datajobs);
                                                                }

                                                            foreach($service_part as $val){
                                                    
                                                            
                                                                $price = DB::connection('ts3')->table('mst.mst_price_service')->where('id',intval($val->unique_data))->first();
                                                                $datapart = [
                                                                    'mvm_invoice_h_id' => $service_id,
                                                                    'service_no' => $serno,
                                                                    'created_date'    => date("Y-m-d h:i:sa"),
                                                                    'create_by'     => $request->session()->get('username'),
                                                                    'mst_price_service_id' => $price->kode,
                                                                    'price_bengkel_to_ts3' => $price->price_bengkel_to_ts3,
                                                                    'invoice_no' => $request->invoice_no,
                                                                    'price_type' => $price->price_service_type,
                                                                    'price_ts3_to_client' => $price->price_ts3_to_client,
                                                                ];

                                                                DB::connection('ts3')->table('mvm.mvm_invoice_d')->insert($datapart);


                                                                }


                 }


                $sumTotalInvoice =  DB::connection('ts3')->table('mvm.v_invoice_detail_prepare')->selectRaw("ROUND((sum(jasa) * 2) / 100) as pph,
                sum(jasa) as jasa,
                sum(part) as part")->where('invoice_no',$request->invoice_no)->first(); 
                    
                DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$request->invoice_no)->update([
                                'pph'               => $sumTotalInvoice->pph,
                                'jasa_total'	    => $sumTotalInvoice->jasa,
                                'part_total'	    => $sumTotalInvoice->part
                            ]);   
                DB::commit();
            }
                     
            catch (\Illuminate\Database\QueryException $e) {
                           DB::rollback();
                           return redirect('admin-ts3/client')->with(['warning' => $e]);
            }
           


        }
        else{

            $checkInvoiceDetail = DB::connection('ts3')->table('mvm.mvm_invoice_d')->where('invoice_no',$request->invoice_no)->where('service_no',$request->service_no)->get();
        
    
            if(count($checkInvoiceDetail)  == 0)
            {
                $checkInvoice = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$request->invoice_no)->first();
            
                try{
                   
                    DB::beginTransaction();
                    foreach($request->id as $serno){
                        $service_jasa = DB::connection('ts3')->table('mvm.v_service_detail_invoice_bengkel')->where('service_no',$serno)->where('detail_type','Pekerjaan')->get(); 
                       
                        $service_part = DB::connection('ts3')->table('mvm.v_service_detail_invoice_bengkel')->where('service_no',$serno)->where('detail_type','Spare Part')->get(); 
                     
                                                                    foreach($service_jasa as $val){
                                                                        $price = DB::connection('ts3')->table('mst.mst_price_service')->where('id',intval($val->unique_data))->first();
        
                                                                        $datajobs = [
                                                                            'mvm_invoice_h_id' => $checkInvoice->id,
                                                                            'service_no' => $serno,
                                                                            'created_date'    => date("Y-m-d h:i:sa"),
                                                                            'create_by'     => $request->session()->get('username'),
                                                                            'mst_price_service_id' => $price->kode,
                                                                            'price_bengkel_to_ts3' => $price->price_bengkel_to_ts3,
                                                                            'invoice_no' => $request->invoice_no,
                                                                            'price_type' => $price->price_service_type,
                                                                            'price_ts3_to_client' => $price->price_ts3_to_client,
                                                                        ];
        
                                                                        DB::connection('ts3')->table('mvm.mvm_invoice_d')->insert($datajobs);
                                                                        }
        
                                                                    foreach($service_part as $val){
                                                            
                                                                    
                                                                        $price = DB::connection('ts3')->table('mst.mst_price_service')->where('id',intval($val->unique_data))->first();
                                                                        $datapart = [
                                                                            'mvm_invoice_h_id' => $checkInvoice->id,
                                                                            'service_no' => $serno,
                                                                            'created_date'    => date("Y-m-d h:i:sa"),
                                                                            'create_by'     => $request->session()->get('username'),
                                                                            'mst_price_service_id' => $price->kode,
                                                                            'price_bengkel_to_ts3' => $price->price_bengkel_to_ts3,
                                                                            'invoice_no' => $request->invoice_no,
                                                                            'price_type' => $price->price_service_type,
                                                                            'price_ts3_to_client' => $price->price_ts3_to_client,
                                                                        ];
        
                                                                        DB::connection('ts3')->table('mvm.mvm_invoice_d')->insert($datapart);
        
        
                                                                        }
        
        
                         }
        
        
                        $sumTotalInvoice =  DB::connection('ts3')->table('mvm.v_invoice_detail_prepare')->selectRaw("ROUND((sum(jasa) * 2) / 100) as pph,
                        sum(jasa) as jasa,
                        sum(part) as part")->where('invoice_no',$request->invoice_no)->first(); 
                            
                        DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$request->invoice_no)->update([
                                        'pph'               => $sumTotalInvoice->pph,
                                        'jasa_total'	    => $sumTotalInvoice->jasa,
                                        'part_total'	    => $sumTotalInvoice->part
                                    ]);   
                        DB::commit();
                    }
                             
                    catch (\Illuminate\Database\QueryException $e) {
                                   DB::rollback();
                                   return redirect('admin-ts3/client')->with(['warning' => $e]);
                    }



            }       
            else{
                return redirect('bengkel/invoice-create')->with(['warning' => 'Service Sudah Di tambahkan']);
            }    

        }

        return redirect('bengkel/invoice-create')->with(['sukses' => 'Data Berhasil Di Tambahkan']);

    }

    public function get_service()
    {

        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $service_no = $_POST['service_no'];
        log::info($service_no);


        $service = DB::connection('ts3')->table('mvm.v_service_bengkel_invoice')->where('service_no',$service_no)->first();  
        return response()->json($service);
     
    }
    

    public function invoice_delete_detail($service_no)
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $invoice = DB::connection('ts3')->table('mvm.mvm_invoice_d')->where('service_no',$service_no)->first();

        DB::connection('ts3')->table('mvm.mvm_invoice_d')->where('service_no',$service_no)->delete();

        $sumTotalInvoice =  DB::connection('ts3')->table('mvm.v_invoice_detail_prepare')->selectRaw("ROUND((sum(jasa) * 2) / 100) as pph,
            sum(jasa) as jasa,
            sum(part) as part")->where('invoice_no',$invoice->invoice_no)->first(); 

        DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$invoice->invoice_no)->update([
            'pph'               => $sumTotalInvoice->pph,
            'jasa_total'	    => $sumTotalInvoice->jasa,
            'part_total'	    => $sumTotalInvoice->part
        ]);  

        return redirect('bengkel/invoice-create')->with(['sukses' => 'Data Service Berhasil Di Hapus']);


    }

    public function invoice_submit(Request $request)
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
          
        DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$request->invoice_no)->update([
            'status'               => 'REQUEST'
        ]);  

        return redirect('bengkel/invoice')->with(['sukses' => 'Data Service Berhasil Di Submit']);
    }
    
    public function invoice_generate($invoice_no)
    {

        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $invoice = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$invoice_no)->first();       
        $invoice_detail = DB::connection('ts3')->table('mvm.v_invoice_generate')->where('invoice_no',$invoice_no)->distinct()->orderby('service_no','ASC')->orderby('jasa','ASC')->get();

        $bengkel = DB::connection('ts3')->table('mst.mst_bengkel')->where('pic_bengkel',$invoice->create_by)->first();  
        $config = DB::connection('ts3')->table('cp.konfigurasi')->first();




        $pdf = PDF::loadview('bengkel/invoice/pdf/invoice_generate',['invoice'=>$invoice, 'invoice_detail' => $invoice_detail,'bengkel' =>$bengkel, 'config' => $config ])->setPaper('a4', 'landscape');
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();

            $w = $canvas->get_width(); 
            $h = $canvas->get_height(); 

        
            $imageURL = storage_path('data/image/logo_pdf.png');
            $imgWidth = 300; 
            $imgHeight = 200; 
            

            $canvas->set_opacity(.1); 
            

            $x = (($w-$imgWidth)/2); 
            $y = (($h-$imgHeight)/2); 
            

            $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight); 

    	return $pdf->download($invoice_no.'.pdf');

    }
    

    public function invoice_reset($invoice_no)
    {
        if(Session()->get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }



        $invoice = DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$invoice_no)->first();


        DB::connection('ts3')->table('mvm.mvm_invoice_d')->where('invoice_no',$invoice_no)->delete();
        DB::connection('ts3')->table('mvm.mvm_invoice_h')->where('invoice_no',$invoice_no)->delete();
        

        return redirect('bengkel/invoice-create')->with(['sukses' => 'Data Service Berhasil Di Hapus']);


    }


    


   


  

   
}
