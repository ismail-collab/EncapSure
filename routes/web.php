<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




/*******  Laravel Pages + Appel des fonctions from userController alimentée les UI's from DB a travers Spring  *******/

// User routes
Route::get('Aghome',[userController::class,'AgentDLPrint']);
Route::get('Clpage',[userController::class,'PrintDL']);
Route::get('dashboard',[userController::class,'PrintDB']);
Route::get('AdminCRUD', [userController::class,'printUser']);

// Devis routes
Route::get('Devisshow', [userController::class,'ShowDevisCurrFiles']);
Route::get('Dvmod', [userController::class,'UpdateDevisShowPack']);
Route::get('Dvpg', [userController::class,'ClientShowPack']);
Route::get('Subs', [userController::class,'DevisToSub']);

// Management routes
Route::get('GestionDevis',[userController::class,'DevisList']);
Route::get('GestionSouscription',[userController::class,'SubssList']);
Route::get('GererPack',[userController::class,'ShowPack']);
Route::get('DownDFiles/{devis_id}',[userController::class,'DownloadAllDFiles']);
Route::get('reupload/{cont_num}',[userController::class,'ReuploadFiles']);

















/***********************  Routes for action in forms  ***********************/
/*Route::post('ActionName', [userController::class,'userController_Fct']);*****************/

// User actions
Route::post('userAdd', [userController::class,'addUser']);
Route::post('userAuth', [userController::class,'UserLogin']);
Route::post('UpdateUser',[userController::class,'ModifyUser']);

// File handling
Route::post('addDL', [userController::class,'CreateDL']);
Route::post('UploadFiles',[userController::class,'SendFiles']);
Route::post('UploadIDFiles',[userController::class,'SendIDFiles']);
Route::post('REUploadFiles',[userController::class,'RESendFiles']);
Route::post('DownFiles',[userController::class,'DownloadFiles']);


// Pack management
Route::post('DownCFiles',[userController::class,'DownloadContFiles']);
Route::post('Pay',[userController::class,'ClientPay']);
Route::post('addpack',[userController::class,'AddPack']);
Route::post('editpack',[userController::class,'EditPack']);

// Address handling
Route::post('Pick_To_Adress',[userController::class,'PickToAdress']);
Route::post('Adress_To_Pay',[userController::class,'AdressToPay']);
Route::post('Pay',[userController::class,'Pay']);

// Subscription processing
Route::post('SubProc',[userController::class,'Subscription']);

// Devis processing
Route::post('DevisPI',[userController::class,'DevisPI']);
Route::post('DevisProc',[userController::class,'Devis']);

// Word document creation
Route::post('WordMaker',[userController::class,'WordMaker']);

// Payment processing
Route::post('SubPay',[userController::class,'SubPay']);
Route::post('SubSign',[userController::class,'SubSign']);
Route::post('DevisPay',[userController::class,'DevisPay']);




//simulation
Route::post('addClient', [userController::class,'AddClient']);














// Redirection des pages 

// If user is a client, render the Client Upload Page, if logged out, redirect to login, else render Not Found page
Route::get('Clup', function () {

    if (checkUser()=="client") {
        return view('ClientUploadPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }

});


// If user is a client, render the Contract Download page, if logged out, redirect to login, else render Not Found page
Route::get('contdown', function () {

    if (checkUser()=="client") {
        return view('ContractDownload');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }

});


// If user is a client, render the Client REUP Page, if logged out, redirect to login, else render Not Found page
Route::get('reupdl', function () {

    if (checkUser()=="client") {
        return view('ClientREUPPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }

});


// If user is a client, render the Client Pay Page, if logged out, redirect to login, else render Not Found page
Route::get('Clpay', function () {

    if (checkUser()=="client") {
        return view('ClientPayPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// If user is a client, render the Client Address Page, if logged out, redirect to login, else render Not Found page
Route::get('Cladr', function () {

    if (checkUser()=="client") {
        return view('ClientAdressPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// If user is a client, render the Subscription Pay Page, if logged out, redirect to login, else render Not Found page
Route::get('Subpay', function () {

    if (checkUser()=="client") {
        return view('SubsPayPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// If user is a client, render the Client Devis Personal Info page, if logged out, redirect to login, else render Not Found page
Route::get('Dvpi', function () {

    if (checkUser()=="client") {
        return view('ClientDevisPersonInfo');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});

// If user is a client, render the Client Devis Pay Page, if logged out, redirect to login, else render Not Found page
Route::get('Dvpay', function () {

    if (checkUser()=="client") {
        return view('ClientDevisPayPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// If user is a client, render the Devis Download page, if logged out, redirect to login, else render Not Found page
Route::get('Dvdown', function () {

    if (checkUser()=="client") {
        return view('DevisDownload');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// If user is a client, render the Subscription Upload Page, if logged out, redirect to login, else render Not Found page
Route::get('Subsup', function () {

    if (checkUser()=="client") {
        return view('SubsUploadPage');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// If user is a client, render the Subscription Signature page, if logged out, redirect to login, else render Not Found page
Route::get('Subssign', function () {

    if (checkUser()=="client") {
        return view('SubsSignature');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});


// Depending on the role of the user, redirect to the respective home page, if logged out, redirect to login, else render Not Found page
Route::get('Home', function () {

    if (checkUser()=="client") {
        return view('ClientHome');
    }
    else if (checkUser()=="agent") {
        return redirect('HomeAgent');
    }
    else if (checkUser()=="admin") {
        return redirect('HomeAdmin');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});

// If user is a client, render the Subscription Pick page, if logged out, redirect to login, else render Not Found page
Route::get('Subspick', function () {

    if (checkUser()=="client") {
        return view('SubsPick');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});

// If user is an admin, render the Admin CRUD add page, if logged out, redirect to login, else render Not Found page
Route::get('Crudadd', function () {

    if (checkUser()=="admin") {
        return view('AdminCRUDadd');
    }
    else if (checkUser()=="OUT") {
        return redirect('Login');
    }
    else {
        return view('NotFound');
    }
});

// If user is logged in, redirect to the respective home page based on role, else render Login page
Route::get('Login', function () {
    if(session()->has('user') && session()->get('role')=="agent" ) {
        return redirect('HomeAgent');
    }
    else if(session()->has('user') && session()->get('role')=="admin" ) {
        return redirect('HomeAdmin');
    }
    if(session()->has('user') && session()->get('role')=="client" ) {
        return redirect('Home');
    }

    return view('Login',['state'=>'OK']);

});

// If user is logged in, log out the user and redirect to login page
Route::get('Logout', function () {
    if(session()->has('user')) {
        session()->pull('user');
        session()->flush();
    }
    return redirect('Login');
});
































/* définition des routes de base de l'application */

Route::get('Inscription', function () {
    return view('Inscription');
});

Route::get('Welcome', function () {
    return view('HomeUser');
});


Route::get('UserSettings', function () {
    return view('UserSettings');
});

Route::get('HomeAgent', function () {
    return view('HomeAgent');
});

Route::get('HomeAdmin', function () {
    return view('HomeAdmin');
});

Route::get('AdminDashboard', function () {
    return view('AdminDashboard');
});

Route::get('AgentDashboard', function () {
    return view('AgentDashboard');
});

Route::get('Client_Dashboard', function () {
    return view('Client_Dashboard');
});

Route::get('ClientTB', function () {
    return view('ClientTB');
});

Route::get('AjouterPack', function () {
    return view('AjouterPack');
});

Route::get('EditPack', function () {
    return view('EditPack');
});

// Simulation d'ajout de client ;
Route::get('AdminCRUDaddClient', function () {
    return view('AdminCRUDaddClient');
});


// insertion par defaut de la fonciton PrintSimulaiton dans la page test ;
Route::get('test', [userController::class,'PrintSimulation']);




Route::get('test2', function () {
    return view('test2');
});





//Test
Route::post('Test2',[userController::class,'test2']);















// Gestion des accées des utilisateurs 
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



//Test
Route::post('Test',[userController::class,'test']);



