<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Models\User;


class userController extends Controller {
   
    function checkUser() {

        if (session()->has('user') && session()->get('role')=="client") {
            return "client";
        } 
        else if (session()->has('user') && session()->get('role')=="agent") {
            return "agent";
        }
        else if (session()->has('user') && session()->get('role')=="admin") {
            return "admin";
        }
    
        else {
            return "OUT";
        }
    
    } 
    

function UserLogin(Request $req) {
//Login with spring token + Gestion d'accées
    $data= Http::post('http://localhost:9090/usersauth', [
    //  "spring"=> $req->input('nameLaravel')                   
        "username"=> $req->input('user'), // Récupération du nom d'utilisateur à partir des données de requête.
        "password"=> $req->input('password') // Récupération du mot de passe à partir des données de requête.
    ]);

// Conversion de la réponse JSON en objet PHP.
 $account=json_decode($data);
 if (!isset($account[0])) {

    // Redirection vers la page de connexion avec un état d'erreur.
    return redirect()->to('Login')->with('state', 'error');}

 else {
    // Stockage des informations d'authentification de l'utilisateur dans la session.    
    $req->session()->put('user',$account[0]->username); // Stockage du nom d'utilisateur.
    $req->session()->put('role',$account[0]->role); // Stockage du rôle de l'utilisateur.
    $req->session()->put('name',$account[0]->firstname." ".$account[0]->lastname); // Stockage du nom complet de l'utilisateur.

    if ($account[0]->role=="agent") {
        return redirect('HomeAgent');
    }
    else if ($account[0]->role=="admin") {
        return redirect('HomeAdmin');
    }
    else if ($account[0]->role=="client") {
        return redirect('Home');
    }
    
 }

}




   
function addUser(Request $req){

    $response = null;

    if ($req->input('role')=="agent") {
        $response = Http::post('http://localhost:9090/adduser', [
            "username"=> $req->input('username'),
            "firstname"=>$req->input('prenom'),
            "lastname"=>$req->input('nom'),
            "password"=> $req->input('password'),
            "email"=> $req->input('email'),
            "role"=>"agent"
        ]);
    }
    else {
        $response = Http::post('http://localhost:9090/adduser', [
            "username"=> $req->input('username'),
            "firstname"=>$req->input('prenom'),
            "lastname"=>$req->input('nom'),
            "password"=> $req->input('password'),
            "email"=> $req->input('email'),
            "role"=>"client"
        ]);
    }

    // Here you would verify the response you got from your request
    // This is an example and you might need to adjust it based on the actual response you get from your request
    if ($response->successful()) {
        return redirect('AdminCRUD')->with('state', 'success');
    }
    else {
        // Here you can return the error message you received, this is just an example
        return back()->with('state', 'error')->with('error_message', $response['message']);
    }
}






function printUser(Request $req){

    if (checkUser()=="admin") {
        $UserList=Http::post('http://localhost:9090/showUsers');
        $data['USERS']=json_decode($UserList);
          return view('AdminCRUD',$data);
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
}



function ModifyUser(Request $req) {

            $data2= Http::post('http://localhost:9090/updateuser', [
                        "username"=> session()->get('user'),
                        "password"=> $req->input('newpassword'),
                        "email"=> $req->input('email')
            ]);
        return redirect('Home');
}




function ClientPay(Request $req) {

    $data= Http::post('http://localhost:9090/clientpaytask',[

        "amountLeft"=>$req->input('la'),
        "name"=>session()->get('user'),
        "amountPaid"=>$req->input('pa')  
    ]);
}





function PrintDL(Request $req) {

    if (checkUser()=="client") {
        $ProdList= Http::post('http://localhost:9090/productlist',[
            "dl_usern"=>session()->get('user')
        ]);
    
        $data['PRODUCT']=json_decode($ProdList);
        return view('ClientPickPage',$data);
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }

}





public function PickToAdress(Request $req) {

    $RECPS= $req->recps;
    $collection = new Collection();
    
    for ($i=1;$i<=array_key_last($RECPS);$i++) {
        if (array_key_exists($i,$RECPS)) {
       
            $temp_array = explode('-', $RECPS[$i]);
           $collection->push(['id'=>$i,'contract_num'=>$temp_array[1],'receipt'=>$temp_array[0],'left_amount'=>$temp_array[2]]); 

        }
    }

    return view('ClientAdressPage')->with('RECPS',$collection);

}




public function AdressToPay(Request $req) {

    $RECPS = $req->recps;
    $Adress = $req->input('country').', '.$req->input('city').', '.$req->input('zip');
    $collection = new Collection();

    for ($i=0;$i<=array_key_last($RECPS);$i++) {
        if (array_key_exists($i,$RECPS)) {
                 
            $temp_array = explode('-', $RECPS[$i]);
            $collection->push(['id'=>$i,'contract_num'=>$temp_array[2],'receipt'=>$temp_array[1],'left_amount'=>$temp_array[3],'Adress' => $Adress]);
    
        }    
    }
 
    return view('ClientPayPage')->with('INFOS',$collection);
}




public function Pay(Request $req) {

    $INFOS = $req->infos;
    $PayData =  $req->input('ccn').'/'.$req->input('sc').'/'.$req->input('exp');
    $collection = new Collection();
    
     for ($i=0;$i<=array_key_last($INFOS);$i++) {
        if (array_key_exists($i,$INFOS)) {
              
            $temp_array = explode('-', $INFOS[$i]);
            $collection->push(['id'=>$i,'contract_num'=>$temp_array[2],'receipt'=>$temp_array[1],'left_amount'=>$temp_array[3],'Adress' => $temp_array[4],'PayData'=>$PayData,'username'=>session()->get('user')]);
            
        }  
    }

        $data= Http::post('http://localhost:9090/clientpaytask',$collection);
        return view('ClientUploadPage')->with('INFOS',$collection);

}







public function AddPack(Request $req) {

    $INFOS = $req->guarantees;
    $collection = new Collection();
    
     for ($i=0;$i<=array_key_last($INFOS);$i++) {
        if (array_key_exists($i,$INFOS)) {
              
            $collection->push(['pack_name'=>$req->input('pack_name'),'price'=>$req->input('price'),'guaranty_id'=>$INFOS[$i]]);
            
        }  
    }

        $data= Http::post('http://localhost:9090/addpack',$collection);
        return redirect('Home');

}




public function EditPack(Request $req) {

 
    $INFOS = $req->guarantees;
    $collection = new Collection();
    
     for ($i=0;$i<=array_key_last($INFOS);$i++) {
        if (array_key_exists($i,$INFOS)) {
              
            $collection->push(['pack_id'=>$req->input('pack_id'),'pack_name'=>$req->input('pack_name'),'price'=>$req->input('price'),'guaranty_id'=>$INFOS[$i]]);
            
        }  
    }

        $data= Http::post('http://localhost:9090/updatepack',$collection);
        return redirect('GererPack');

}





function ShowPack(Request $req) {

    $data= Http::post('http://localhost:9090/showpack');
    $info = json_decode($data);

    //dd($info);
    $temp_array = [];
    $temp_id = [];
    $infos = new Collection();
    $leave = false;
    $j = 0;

    for ($i=0; $i<count($info); $i++) {
       // dd(count($info));

        if ($i == 0) {

            $temp_array = ['pack_id'=>$info[0]->pack_id,'pack_name'=>$info[0]->pack_name,'price'=>$info[0]->price];
            for ($x = 0; $x<$info[0]->guaranty_id; $x++){
                if ($x+1 == $info[0]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[0]->guaranty_id];
                    $j=$info[0]->guaranty_id;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }

           

        }


        else if ($i == count($info)-1 && $info[$i]->pack_id === $info[$i-1]->pack_id) {

            
            if (count($temp_array) < 10) {
                

                 for ($x = count($temp_array)-2; $x<8; $x++) {

                        if ($info[$i]->guaranty_id == $x) {
                            $temp_array = $temp_array + ['gr'.$x => $info[$i]->guaranty_id];
                        }
                        else {
                            $temp_array = $temp_array + ['gr'.$x => 0];
                        }   
                }
             }

            //dd($temp_array,$temp_id);
            $infos->push($temp_array);
        }

        else if ($i == count($info)-1 && $info[$i]->pack_id !== $info[$i-1]->pack_id) {
       

            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
          
            $j=0;
            $temp_array = [];
            $temp_id = [];

            $temp_array = ['pack_id'=>$info[$i]->pack_id,'pack_name'=>$info[$i]->pack_name,'price'=>$info[$i]->price];
            for ($x = 0; $x<$info[$i]->guaranty_id; $x++){
                if ($x+1 == $info[$i]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[$i]->guaranty_id];
                    $j=$info[$i]->guaranty_id+1;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }

            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
        }

        else if ($info[$i]->pack_id !== $info[$i-1]->pack_id ) {


            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
          

            $j=0;
            $temp_array = [];
            $temp_id = [];

            $temp_array = ['pack_id'=>$info[$i]->pack_id,'pack_name'=>$info[$i]->pack_name,'price'=>$info[$i]->price];
            for ($x = 0; $x<$info[$i]->guaranty_id; $x++){
                if ($x+1 == $info[$i]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[$i]->guaranty_id];
                    $j=$info[$i]->guaranty_id+1;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }
            //100% Safe
           
        }


        else {
      

            $leave=false;
            while (!$leave) {
                
                if ($j == $info[$i]->guaranty_id) {
                    
                    $temp_id = $temp_id + ['gr'.$j => $info[$i]->guaranty_id ];
                    $temp_array = $temp_array +  $temp_id;
                    $temp_id = [];
                    $leave=true;
                }

                else if ($j != $info[$i]->guaranty_id ) {
                    $temp_id = $temp_id + ['gr'.$j => 0];
                    $j++;
                }
                
            }
         //  dd($j.' / '.$info[$i]->guaranty_id. ' / '.$i, $temp_array);
          
        }

        
      
    }
 //dd($infos);

    return view('GererPack')->with('INFOS',$infos);

}



function UpdateDevisShowPack(Request $req) {

    $data= Http::post('http://localhost:9090/showpack');
    $info = json_decode($data);

    //dd($info);
    $temp_array = [];
    $temp_id = [];
    $infos = new Collection();
    $leave = false;
    $j = 0;

    for ($i=0; $i<count($info); $i++) {
       // dd(count($info));

        if ($i == 0) {

            $temp_array = ['pack_id'=>$info[0]->pack_id,'pack_name'=>$info[0]->pack_name,'price'=>$info[0]->price];
            for ($x = 0; $x<$info[0]->guaranty_id; $x++){
                if ($x+1 == $info[0]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[0]->guaranty_id];
                    $j=$info[0]->guaranty_id;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }

           

        }


        else if ($i == count($info)-1 && $info[$i]->pack_id === $info[$i-1]->pack_id) {

            
            if (count($temp_array) < 10) {
                

                 for ($x = count($temp_array)-2; $x<8; $x++) {

                        if ($info[$i]->guaranty_id == $x) {
                            $temp_array = $temp_array + ['gr'.$x => $info[$i]->guaranty_id];
                        }
                        else {
                            $temp_array = $temp_array + ['gr'.$x => 0];
                        }   
                }
             }

            //dd($temp_array,$temp_id);
            $infos->push($temp_array);
        }

        else if ($i == count($info)-1 && $info[$i]->pack_id !== $info[$i-1]->pack_id) {
       

            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
          
            $j=0;
            $temp_array = [];
            $temp_id = [];

            $temp_array = ['pack_id'=>$info[$i]->pack_id,'pack_name'=>$info[$i]->pack_name,'price'=>$info[$i]->price];
            for ($x = 0; $x<$info[$i]->guaranty_id; $x++){
                if ($x+1 == $info[$i]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[$i]->guaranty_id];
                    $j=$info[$i]->guaranty_id+1;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }

            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
        }

        else if ($info[$i]->pack_id !== $info[$i-1]->pack_id ) {


            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
          

            $j=0;
            $temp_array = [];
            $temp_id = [];

            $temp_array = ['pack_id'=>$info[$i]->pack_id,'pack_name'=>$info[$i]->pack_name,'price'=>$info[$i]->price];
            for ($x = 0; $x<$info[$i]->guaranty_id; $x++){
                if ($x+1 == $info[$i]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[$i]->guaranty_id];
                    $j=$info[$i]->guaranty_id+1;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }
            //100% Safe
           
        }


        else {
      

            $leave=false;
            while (!$leave) {
                
                if ($j == $info[$i]->guaranty_id) {
                    
                    $temp_id = $temp_id + ['gr'.$j => $info[$i]->guaranty_id ];
                    $temp_array = $temp_array +  $temp_id;
                    $temp_id = [];
                    $leave=true;
                }

                else if ($j != $info[$i]->guaranty_id ) {
                    $temp_id = $temp_id + ['gr'.$j => 0];
                    $j++;
                }
                
            }
         //  dd($j.' / '.$info[$i]->guaranty_id. ' / '.$i, $temp_array);
          
        }

        
      
    }
   // dd($infos);

    return view('DevisUpdate')->with('INFOS',$infos);

}




function ClientShowPack(Request $req) {

    $data= Http::post('http://localhost:9090/showpack');
    $info = json_decode($data);

    //dd($info);
    $temp_array = [];
    $temp_id = [];
    $infos = new Collection();
    $leave = false;
    $j = 0;

    for ($i=0; $i<count($info); $i++) {
       // dd(count($info));

        if ($i == 0) {

            $temp_array = ['pack_id'=>$info[0]->pack_id,'pack_name'=>$info[0]->pack_name,'price'=>$info[0]->price];
            for ($x = 0; $x<$info[0]->guaranty_id; $x++){
                if ($x+1 == $info[0]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[0]->guaranty_id];
                    $j=$info[0]->guaranty_id;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }

           

        }


        else if ($i == count($info)-1 && $info[$i]->pack_id === $info[$i-1]->pack_id) {

            
            if (count($temp_array) < 10) {
                

                 for ($x = count($temp_array)-2; $x<8; $x++) {

                        if ($info[$i]->guaranty_id == $x) {
                            $temp_array = $temp_array + ['gr'.$x => $info[$i]->guaranty_id];
                        }
                        else {
                            $temp_array = $temp_array + ['gr'.$x => 0];
                        }   
                }
             }

            //dd($temp_array,$temp_id);
            $infos->push($temp_array);
        }

        else if ($i == count($info)-1 && $info[$i]->pack_id !== $info[$i-1]->pack_id) {
       

            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
          
            $j=0;
            $temp_array = [];
            $temp_id = [];

            $temp_array = ['pack_id'=>$info[$i]->pack_id,'pack_name'=>$info[$i]->pack_name,'price'=>$info[$i]->price];
            for ($x = 0; $x<$info[$i]->guaranty_id; $x++){
                if ($x+1 == $info[$i]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[$i]->guaranty_id];
                    $j=$info[$i]->guaranty_id+1;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }

            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
        }

        else if ($info[$i]->pack_id !== $info[$i-1]->pack_id ) {


            if (count($temp_array) < 10) {
               
                for ($x = count($temp_array)-2; $x<8; $x++) {
                    $temp_array = $temp_array + ['gr'.$x => 0];
                }
            }

            $infos->push($temp_array);
          

            $j=0;
            $temp_array = [];
            $temp_id = [];

            $temp_array = ['pack_id'=>$info[$i]->pack_id,'pack_name'=>$info[$i]->pack_name,'price'=>$info[$i]->price];
            for ($x = 0; $x<$info[$i]->guaranty_id; $x++){
                if ($x+1 == $info[$i]->guaranty_id) {
                    $temp_array = $temp_array + ['gr'.$x+1 => $info[$i]->guaranty_id];
                    $j=$info[$i]->guaranty_id+1;
                }
                else {
                    $temp_array = $temp_array + ['gr'.$x+1 => 0];
                }
                
            }
            //100% Safe
           
        }


        else {
      

            $leave=false;
            while (!$leave) {
                
                if ($j == $info[$i]->guaranty_id) {
                    
                    $temp_id = $temp_id + ['gr'.$j => $info[$i]->guaranty_id ];
                    $temp_array = $temp_array +  $temp_id;
                    $temp_id = [];
                    $leave=true;
                }

                else if ($j != $info[$i]->guaranty_id ) {
                    $temp_id = $temp_id + ['gr'.$j => 0];
                    $j++;
                }
                
            }
         //  dd($j.' / '.$info[$i]->guaranty_id. ' / '.$i, $temp_array);
          
        }

        
      
    }
   // dd($infos);

    return view('DevisForms')->with('INFOS',$infos);

}







function SendFiles(Request $req) {

    $req->validate([
        "tech"=> ['nullable','mimes:jpg,jpeg,pdf','max:4096'],
        "vig"=> ['nullable','mimes:jpg,jpeg,pdf','max:4096']
    ]);

    $INFOS = $req->infos;
    $collection = new Collection();
    $tech = $req->file('tech');
    $vig= $req->file('vig');
    $vignette = base64_encode(file_get_contents($vig));
    $tech_visit = base64_encode(file_get_contents($tech));
    
    for ($i=0;$i<=array_key_last($INFOS);$i++) {
        if (array_key_exists($i,$INFOS)) {
              
            $temp_array = explode('-', $INFOS[$i]);
            $collection->push(['id'=>$i,'contract_num'=>$temp_array[0],'receipt'=>$temp_array[1],'username'=>session()->get('user'),'vignette'=>$vignette,'tech_visit'=>$tech_visit]);
            
        }  
    }
    
   $data= Http::post('http://localhost:9090/clientuptask',$collection);

   return redirect('Clpage');
}





function SendIDFiles(Request $req) {

    $req->validate([
        "id_doc"=> ['nullable','mimes:jpg,jpeg,pdf','max:4096']
    ]);

    $INFOS = $req->infos;
    $collection = new Collection();
    $ids = $req->file('id_doc');
    
    $ids_doc = base64_encode(file_get_contents($ids));
    
    
   $data= Http::post('http://localhost:9090/subuptask',[

    "username"=>session()->get('user'),
    "vignette"=>$ids_doc

   ]);

   return redirect('Subssign');
}



function RESendFiles(Request $req) {

    $req->validate([
        "tech"=> ['nullable','mimes:jpg,jpeg,pdf','max:4096'],
        "vig"=> ['nullable','mimes:jpg,jpeg,pdf','max:4096']
    ]);

  
    $collection = new Collection();
    $tech = $req->file('tech');
    $vig= $req->file('vig');
    $vignette = base64_encode(file_get_contents($vig));
    $tech_visit = base64_encode(file_get_contents($tech));
    

   $data= Http::post('http://localhost:9090/clientreuptask',[

    "username"=>session()->get('user'),
    "vignette"=>$vignette,
    "tech_visit"=>$tech_visit,
    "contract_num"=>$req->input('contract')

   ]);

   return redirect('Home');
}




function DownloadFiles(Request $req) {

    $data= Http::post('http://localhost:9090/deviscurrshow',[
        "dv_usern"=>session()->get('user')
    ]);

    $vars= json_decode($data);

    $file = base64_decode($vars->devis_doc);


    return response()->streamDownload(function () use ($file) {
        echo $file;
    },"Devis.pdf");


}



function ReuploadFiles($thisCont = null) {

    session()->put('dl',$thisCont);



    return redirect('reupdl');

}



function DownloadAllDFiles($thisD = null) {

    $data= Http::post('http://localhost:9090/devishist',[
        "dv_usern"=>session()->get('user')
    ]);

    $vars= json_decode($data);
    //dd($thisD);

    foreach ($vars as $dev) {
        for ($i=0;$i<=count($vars);$i++) {
            
            if ($dev->devis_id==$thisD) {
                
    
                $file = base64_decode($dev->devis_doc);
            }
        }
    }


    return response()->streamDownload(function () use ($file) {
        echo $file;
    },"Devis.pdf");


}



function DownloadAllCFiles($thisD = null) {

    $data= Http::post('http://localhost:9090/devishist',[
        "dv_usern"=>session()->get('user')
    ]);

    $vars= json_decode($data);
    //dd($thisD);

    foreach ($vars as $dev) {
        for ($i=0;$i<=count($vars);$i++) {
            
            if ($dev->devis_id==$thisD) {
                
    
                $file = base64_decode($dev->devis_doc);
            }
        }
    }


    return response()->streamDownload(function () use ($file) {
        echo $file;
    },"Devis.pdf");


}




function DownloadContFiles(Request $req) {

    $data= Http::post('http://localhost:9090/contdownload',[
        "dv_usern"=>session()->get('user')
    ]);

    $vars= json_decode($data);

    $file = base64_decode($vars->contract);


    return response()->streamDownload(function () use ($file) {
        echo $file;
    },"Contract.pdf");


}



function DevisList(Request $req) {

    if (checkUser()=="agent"||checkUser()=="admin") {
        $data= Http::post('http://localhost:9090/devishist',[
            "dv_usern"=>session()->get('user')
        ]);
    
        $vars['DEVIS'] = json_decode($data);
    
       // $file = base64_decode($vars->devis_doc);
    
       // $transfer = base64_encode($file);
    
        return view('GestionDevis')->with('DEVIS',$vars);
    
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }


}


function SubssList(Request $req) {

    if (checkUser()=="agent"||checkUser()=="admin") {
        $data= Http::post('http://localhost:9090/subshow',[
            "dv_usern"=>session()->get('user')
        ]);
    
        $vars['SUBS'] = json_decode($data);
    
       // $file = base64_decode($vars->devis_doc);
    
       // $transfer = base64_encode($file);

    
    
        return view('GestionSouscription')->with('SUBS',$vars);
    
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }


}

function ShowDevisCurrFiles(Request $req) {

    if (checkUser()=="client") {
        $data= Http::post('http://localhost:9090/deviscurrshow',[
            "dv_usern"=>session()->get('user')
        ]);
    
        $vars['DEVIS'] = json_decode($data);
    
       // $file = base64_decode($vars->devis_doc);
    
       // $transfer = base64_encode($file);
    
        return view('SubsDevisShow')->with('DEVIS',$vars);
    
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }


}

function ShowDevisFiles(Request $req) {

    if (checkUser()=="client") {
        $data= Http::post('http://localhost:9090/devisfiledownload',[
            "dv_usern"=>session()->get('user')
        ]);
    
        $vars['DEVIS'] = json_decode($data);
    
       // $file = base64_decode($vars->devis_doc);
    
       // $transfer = base64_encode($file);
    
        return view('SubsDevisShow')->with('DEVIS',$vars);
    
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }


}



function DevisToSub(Request $req) {

    if (checkUser()=="client") {
        $data= Http::post('http://localhost:9090/devisfiledownload',[
            "dv_usern"=>session()->get('user')
        ]);
    
        $vars['DEVIS'] = json_decode($data);
    
    
    
       // $file = base64_decode($vars->devis_doc);
    
       // $transfer = base64_encode($file);
    
        return view('SubsForms',$vars);
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }



}




function Subscription(Request $req) {

    $data= Http::post('http://localhost:9090/devisfiledownload',[
        "dv_usern"=>session()->get('user')
    ]);

    $vars = json_decode($data);
    $extra = 0;

    if ($req->input('deliv_type')=="express") {
        $extra = 10;
    }
    else {
        $extra = 0;
    }

    $data= Http::post('http://localhost:9090/SubsReq', [
        //spring => Laravel 
        "cin"=> $req->input('cin'),
        "client_firstname"=> $req->input('cl_fn'),
        "client_lastname"=> $req->input('cl_ln'),
        "birth_date"=> $req->input('bday'),
        "fraction"=> $req->input('fraction'),
        "renew"=> $req->input('renew'),
        "effect_date"=> $req->input('effect_date'),
        "deadline"=> $req->input('deadline'),
        "delivery_adress"=> $req->input('deliv_adr'),
        "delivery_type"=> $req->input('deliv_type'),
        "phone"=> $req->input('phone'),
        "gender"=> $req->input('gender'),
        "job"=> $req->input('job'),
        "money"=>(int) $vars->money + $extra,
        "sub_usern"=> session()->get('user'),
        "email"=> $req->input('email')
      
    ]);

    //dd(response()->json($data)->getStatuscode());
    if ($data->body()=="Success") {
        $data2= Http::post('http://localhost:9090/subpaytask',[
            "username"=>session()->get('user')
        ]);

        if ($data2->body()=="Success") {
            return redirect('Subsup');
        }
    }


}


function SubSign() {

    $data= Http::post('http://localhost:9090/subsigntask',[
        "username"=>session()->get('user')
    ]);

    return redirect('contdown');

}




public function SubPay(Request $req) {

  

  return redirect('Subsup');

}




public function DevisPay(Request $req) {

    $data= Http::post('http://localhost:9090/devisintask',[
        "username"=>session()->get('user')
    ]);

    return redirect('Dvdown');
  
}



function WordMaker(Request $req) {
    $dataDevis= Http::post('http://localhost:9090/deviscurrshow',[
        "dv_usern"=>session()->get('user')
    ]);

    $vars = json_decode($dataDevis);
    //dd($vars->devis_id);
    $money = 0;

    $money = $req->input('final_money');

    $data= Http::post('http://localhost:9090/word', [
        "devis_id"=> $vars->devis_id,
        "immat"=> $req->input('immat'),
        "immat_type"=> $req->input('immat_type'),
        "job"=> $req->input('job'),
        "serie"=> $req->input('serie'),
        "usage_type"=> $req->input('usage_type'),
        "seat"=> $req->input('seat'),
        "horse"=> $req->input('horse'),
        "price_new"=> $req->input('price_new'),
        "price_venal"=> $req->input('price_venal'),
        "marque"=> $req->input('marque'),
        "circ_date"=> $req->input('circ_date'),
        "km"=> $req->input('km'),
        "model"=> $req->input('model'),
        "dv_usern"=> session()->get('user'),
        "client_firstname"=> $req->input('cl_fn'),
        "client_lastname"=> $req->input('cl_ln'),
        "phone"=> $req->input('phone'),
        "email"=> $req->input('email'),
        "gender"=> $req->input('gender'),
        "cin"=> $req->input('cin'),
        "birth_date"=> $req->input('bday'),
        "money"=> $money,
        "malus"=>8,
        "pack"=> $req->input('pack')
        

    ]);


    return redirect('Devisshow');

}

function Devis(Request $req) {

    $money = 0;    

   

  //  $money = $money + ($req->input('price_new')/100); 

    $money = $req->input('final_money');

    $data= Http::post('http://localhost:9090/DevisReq', [
        "immat"=> $req->input('immat'),
        "immat_type"=> $req->input('immat_type'),
        "job"=> $req->input('job'),
        "serie"=> $req->input('serie'),
        "usage_type"=> $req->input('usage_type'),
        "seat"=> $req->input('seat'),
        "horse"=> $req->input('horse'),
        "price_new"=> $req->input('price_new'),
        "price_venal"=> $req->input('price_venal'),
        "marque"=> $req->input('marque'),
        "circ_date"=> $req->input('circ_date'),
        "km"=> $req->input('km'),
        "model"=> $req->input('model'),
        "dv_usern"=> session()->get('user'),
        "client_firstname"=> $req->input('cl_fn'),
        "client_lastname"=> $req->input('cl_ln'),
        "phone"=> $req->input('phone'),
        "email"=> $req->input('email'),
        "gender"=> $req->input('gender'),
        "cin"=> $req->input('cin'),
        "birth_date"=> $req->input('bday'),
        "money"=> $money,
        "malus"=>8,
        "pack"=> $req->input('pack')

    ]);
    $data2= Http::post('http://localhost:9090/devisintask',[
        "username"=>session()->get('user')
    ]);

    return redirect('Dvdown');

}


function PrintDB(Request $req) {

    if (checkUser()=="client") {
        $ProdList= Http::post('http://localhost:9090/productlisthis',[
            "dl_usern"=>session()->get('user')
        ]);
    
        $data['PRODUCT']=json_decode($ProdList);
        
      return view('ClientDashboard',$data);
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }

}


function AgentDLPrint(Request $req) {

    if (checkUser()=="agent") {

        $data = Http::post('http://localhost:9090/dlstats');

        $deadlines['DLS'] = json_decode($data);
    
        return view('AgentHome',$deadlines);
        
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }

}


function AddClient(Request $req) {


    $data = Http::post('http://localhost:9090/adduser',[
       "firstname"=>$req->input('nom'),
       "lastname"=>$req->input('prenom'),
       "username"=>$req->input('username'),
       "email"=>$req->input('email'),
       "password"=>$req->input('password'),
       "role"=>$req->input('role')
       
    ]);

   
   return redirect('AdminCRUD');
       

}





function PrintSimulation(Request $req) {

     $SimulationData= Http::post('http://localhost:9090/clientinfos');
     $data['Simulation']=json_decode($SimulationData);
        
      return view('test',$data);

}


function test(Request $req) {

    $test= Http::post('http://localhost:9090/testreq');
        
     return view('test');

}


function test2(Request $req) {

    $test= Http::post('http://localhost:9090/test2');
        
     return view('test2');

}

//zedet hethi ! 
/*


public function DevisPay(Request $req) {

    $data= Http::post('http://localhost:9090/devisintask',[
        "username"=>session()->get('user')
    ]);

    return redirect('Dvdown');
  
}


*/


} // This is the end of the class

// nemchi spring nhot el fct mta3 addclient ? Well first, you get spmething wrong, you're making a function to add, not to show a page here
// eyh chnowa namel maneha ? First of all, you wanna add a user ? Whre will you input his data ???
// eyh nzid page mta3 add user ? ofc ok 
// done for laravel ? LOL

