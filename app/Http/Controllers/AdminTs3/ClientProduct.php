<?php
namespace App\Http\Controllers\AdminTs3;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use File;

class ClientProduct extends Controller
{
    // Index
    public function index()
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}

      
        $client 	= DB::connection('ts3')->table('mst.v_client_product')->get();
      
        $product 	= DB::connection('ts3')->table('mst.mst_product')->get();
		$data = array(  'title'     => 'Client',
                        'product'      => $product,
                        'clientdata'      => $client,
                        'content'   => 'admin-ts3/client_product/index'
                    );
        
        return view('admin-ts3/layout/wrapper',$data);
    }

    public function index_product()
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}

      

        $product 	= DB::connection('ts3')->table('mst.mst_product')->get();

		$data = array(  'title'     => 'Product',
                        'product'      => $product,
                
                        'content'   => 'admin-ts3/client_product/index_product'
                    );
        
        return view('admin-ts3/layout/wrapper',$data);
    }

    public function tambah(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
					        'client_name' => 'required|unique:ts3.mst.mst_client',
					        'client_type' 	   => 'required',
                            'mst_product_id' 	   => 'required',
                            'legal_name'    => 'required',
                            'contact'    => 'required',
                            'email_client'    => 'required',
					        ]);


        $imagereq = $request->file('img_client');
        if(!empty($imagereq)) {
            try{
                DB::connection('ts3')->beginTransaction();
                $image  = $request->file('img_client');
                $filename =  $request->client_name.'-'.date("ymdhis").'.jpg';
                $destinationPath =storage_path('data/image/client');
                
                if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath,0755,true);
                }
                $img = Image::make($image->path());
                $img->resize(850, 850, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$filename);

            $id_client = DB::connection('ts3')->table('mst.mst_client')->insertGetId([
                'client_name'   => $request->client_name,
                'legal_name'   => $request->legal_name,
                'address'   => $request->address,
                'contact'   => $request->contact,
                'email_client'   => $request->email_client,
                'img_client'   => $filename,
                'path_image'   => $request->img_client,
                'path_image'   => $destinationPath,
                'client_type'	=> $request->client_type,
                'created_date'    => date("Y-m-d h:i:sa"),
                'create_by'     => $request->session()->get('username')
            ]);


            foreach($request->mst_product_id as $val){
                $datasets = [
                    'mst_client_id' => $id_client,
                    'mst_product_id' => $val,
                    'created_date'    => date("Y-m-d h:i:sa"),
                    'create_by'     => $request->session()->get('username')
                ];

                DB::connection('ts3')->table('mst.mst_client_product')->insert($datasets);
            }
            DB::connection('ts3')->commit();
             }
          
            catch (\Illuminate\Database\QueryException $e) {
                DB::connection('ts3')->rollback();
                return redirect('admin-ts3/client')->with(['warning' => $e]);
            }
        }
        else
        {

            try{
                DB::connection('ts3')->beginTransaction();
            $id_client = DB::connection('ts3')->table('mst.mst_client')->insertGetId([
                'client_name'   => $request->client_name,
                'legal_name'   => $request->legal_name,
                'address'   => $request->address,
                'contact'   => $request->contact,
                'email_client'   => $request->email_client,
                'client_type'	=> $destinationPath,
                'created_date'    => date("Y-m-d h:i:sa"),
                'create_by'     => $request->session()->get('username')
            ]);


            foreach($request->mst_product_id as $val){
                $datasets = [
                    'mst_client_id' => $id_client,
                    'mst_product_id' => $val,
                    'created_date'    => date("Y-m-d h:i:sa"),
                    'create_by'     => $request->session()->get('username')
                ];

                DB::connection('ts3')->table('mst.mst_client_product')->insert($datasets);
            }
            DB::connection('ts3')->commit();
             }
          
            catch (\Illuminate\Database\QueryException $e) {
                DB::connection('ts3')->rollback();
                return redirect('admin-ts3/client')->with(['warning' => $e]);
            }


        }


        return redirect('admin-ts3/client')->with(['sukses' => 'Data telah ditambah']);
    }

    public function tambah_product(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
					        'product_name' => 'required|unique:ts3.mst.mst_product',
					        'scheme_db' 	   => 'required',
					        ]);


        DB::connection('ts3')->table('mst.mst_product')->insert([
            'product_name'   => $request->product_name,
            'scheme_db'	=> $request->scheme_db,
            'created_date'    => date("Y-m-d h:i:sa"),
            'create_by'     => $request->session()->get('username')
        ]);
        return redirect('admin-ts3/product')->with(['sukses' => 'Data telah ditambah']);
    }


    public function edit_product($id)
    {
            if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
           
            $product   =   DB::connection('ts3')->table('mst.mst_product')->where('id',$id)->first();
           
		    $data = array(  'title'     => 'Edit Product',
						
                        'product'      => $product,
                        'content'   => 'admin-ts3/client_product/edit_product'
                    );
        
             return view('admin-ts3/layout/wrapper',$data);
    }

    public function edit($id)
    {
            if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
           
            $client   =   DB::connection('ts3')->table('mst.v_client_product')->where('id',$id)->first();
            $product 	= DB::connection('ts3')->table('mst.mst_product')->get();
		    $data = array(  'title'     => 'Edit Client',
                        'product'      => $product,
                        'clientdata'      => $client,
                        'content'   => 'admin-ts3/client_product/edit'
                    );
        
             return view('admin-ts3/layout/wrapper',$data);
    }
    
    public function proses_edit(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
					        'client_name'     => 'required',
                            'client_type' => 'required',
                            'mst_product_id' 	   => 'required',
                            'legal_name'    => 'required',
                            'contact'    => 'required',
                            'email_client'    => 'required',
					        ]);

                            $imagereq = $request->file('img_client');
                            if(!empty($imagereq)) {
                                try{    
                                    DB::connection('ts3')->beginTransaction();    
                                    $check = DB::connection('ts3')->table('mst.mst_client')->where('id',$request->id)->first();

                                 
                                    if(!$check->img_client == null)
                                    {
                    
                                        File::delete(storage_path('data/image/client/'.$check->img_client));
                                    }


                                    $image  = $request->file('img_client');
                                    $filename =  $request->client_name.'-'.date("ymdhis").'.jpg';
                                    $destinationPath =storage_path('data/image/client');
                                    
                                    if (!file_exists($destinationPath)) {
                                    File::makeDirectory($destinationPath,0755,true);
                                    }
                                    $img = Image::make($image->path());
                                    $img->resize(850, 850, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save($destinationPath.'/'.$filename);


                                    DB::connection('ts3')->table('mst.mst_client')->where('id',$request->id)->update([
                                        'client_name'   => $request->client_name,
                                        'legal_name'   => $request->legal_name,
                                        'address'   => $request->address,
                                        'contact'   => $request->contact,
                                        'email_client'   => $request->email_client,
                                        'img_client'   => $filename,
                                        'path_image'   => $destinationPath,
                                        'client_type'	=> $request->client_type,
                                        'updated_at'    => date("Y-m-d h:i:sa"),
                                        'update_by'     => $request->session()->get('username')
                                    ]);   
        
                                    DB::connection('ts3')->table('mst.mst_client_product')->where('mst_client_id',$request->id)->delete();
                                    foreach($request->mst_product_id as $val){
                                        $datasets = [
                                            'mst_client_id' => $request->id,
                                            'mst_product_id' => $val,
                                            'created_date'    => date("Y-m-d h:i:sa"),
                                            'create_by'     => $request->session()->get('username')
                                        ];
                            
                                        DB::connection('ts3')->table('mst.mst_client_product')->insert($datasets);
                                    }


                                    DB::connection('ts3')->commit();

                                }
                                catch (\Illuminate\Database\QueryException $e) {
                                    DB::connection('ts3')->rollback();
                                    return redirect('admin-ts3/client')->with(['warning' => $e]);
                                }

                            }
                            else
                            {
                                try{  
                                    DB::connection('ts3')->beginTransaction();
                                    DB::connection('ts3')->table('mst.mst_client')->where('id',$request->id)->update([
                                        'client_name'   => $request->client_name,
                                        'legal_name'   => $request->legal_name,
                                        'address'   => $request->address,
                                        'contact'   => $request->contact,
                                        'email_client'   => $request->email_client,
                                        'client_type'	=> $request->client_type,
                                        'updated_at'    => date("Y-m-d h:i:sa"),
                                        'update_by'     => $request->session()->get('username')
                                    ]);   
        
                                    DB::connection('ts3')->table('mst.mst_client_product')->where('mst_client_id',$request->id)->delete();
                                    foreach($request->mst_product_id as $val){
                                        $datasets = [
                                            'mst_client_id' => $request->id,
                                            'mst_product_id' => $val,
                                            'created_date'    => date("Y-m-d h:i:sa"),
                                            'create_by'     => $request->session()->get('username')
                                        ];
                            
                                        DB::connection('ts3')->table('mst.mst_client_product')->insert($datasets);
                                    }
  
                                    DB::connection('ts3')->commit();
                                }
                                catch (\Illuminate\Database\QueryException $e) {
                                    DB::connection('ts3')->rollback();
                                    return redirect('admin-ts3/client')->with(['warning' => $e]);
                                }

                            }

        return redirect('admin-ts3/client')->with(['sukses' => 'Data telah diupdate']);                                             
    }

    public function proses_edit_product(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
					        'product_name'     => 'required',
                            'scheme_db' => 'required',
					        ]);

                            DB::connection('ts3')->table('mst.mst_product')->where('id',$request->id)->update([
                                'product_name'   => $request->product_name,
                                'scheme_db'	=> $request->scheme_db,
                                'updated_at'    => date("Y-m-d h:i:sa"),
                                'update_by'     => $request->session()->get('username')
                            ]);   
        return redirect('admin-ts3/product')->with(['sukses' => 'Data telah diupdate']);                                             
    }

    public function delete($id)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
     
        DB::connection('ts3')->table('mst.mst_client')->where('id',$id)->delete();
        DB::connection('ts3')->table('mst.mst_client_product')->where('mst_client_id',$id)->delete();
        return redirect('admin-ts3/client')->with(['sukses' => 'Data telah dihapus']);
    }

    public function delete_product($id)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
     
        DB::connection('ts3')->table('mst.mst_product')->where('id',$id)->delete();
        return redirect('admin-ts3/product')->with(['sukses' => 'Data telah dihapus']);
    }
       

    public function proses(Request $request)
    {
        $site   =DB::connection('ts3')->table('cp.konfigurasi')->first();
        // PROSES HAPUS MULTIPLE

        if(isset($_POST['hapus'])) {
            $id       = $request->id;
     
            for($i=0; $i < sizeof($id);$i++) {
                      
               DB::connection('ts3')->table('mst.mst_client')->where('id',$id[$i])->delete();
               DB::connection('ts3')->table('mst.mst_client_product')->where('mst_client_id',$id)->delete();
             
            }
        
            return redirect('admin-ts3/client')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DRAFT
        }
    }

    public function proses_product(Request $request)
    {
        $site   =DB::connection('ts3')->table('cp.konfigurasi')->first();
        // PROSES HAPUS MULTIPLE

        if(isset($_POST['hapus'])) {
            $id       = $request->id;
     
            for($i=0; $i < sizeof($id);$i++) {
                      
               DB::connection('ts3')->table('mst.mst_product')->where('id',$id[$i])->delete();
             
            }
        
            return redirect('admin-ts3/product')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DRAFT
        }
    }
   
   
    public function get_image($id)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
           
        $client   =   DB::connection('ts3')->table('mst.v_client_product')->where('img_client',$id)->first();

        $storagePath =  $client->path_image.'/'.$client->img_client;

        if(!file_exists($storagePath))
        return redirect('admin-ts3/client')->with(['warning' => 'File Tidak Di temukan']);
        
        else{
            return response()->file($storagePath);
        }

    }

    
}
