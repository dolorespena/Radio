<?php

include_once 'models/columnists.model.php';
include_once 'models/podcasts.model.php';
include_once 'models/image.model.php';
include_once 'views/admin.view.php';
include_once 'views/message.view.php';
include_once 'views/podcasts.view.php';
include_once 'helpers/auth.helper.php';


class AdminController{

    private $modelColumnists;
    private $modelPodcasts;
    private $view;
    private $viewMessage;
    private $modelUser;
    private $modelImage;

    public function __construct() {

        AuthHelper::checkAdmin();
        $this->modelColumnists = new ColumnistsModel();
        $this->modelPodcasts = new PodcastsModel();
        $this->view = new AdminView();
        $this->viewMessage = new MessageView();
        $this->viewPodcasts = new PodcastsView();
        $this->modelUser = new UserModel();
        $this->modelImage = new ImageModel();
    }

    public function showAdmin(){
        $columnists = $this->modelColumnists->getAll();
        $podcasts = $this->modelPodcasts->getAll();
        $this->view->showAdmin($columnists, $podcasts);
    }

    public function addColumnist(){

        // toma los valores enviados por el usuario
        $nombre = $_POST['nombre'];
        $profesion = $_POST['profesion'];
        $descripcion = $_POST['descripcion'];
        $imagenes = $_FILES ['imagenes'];

        // verifica los datos obligatorios

        if (!empty($nombre) && !empty($profesion) &&  !empty($descripcion) && $imagenes['error'][0] != 4) {

            $isValid = $this->isValidTypeAll($imagenes, 'image');

            if ($isValid){
                $idColumnist = $this->modelColumnists->insertColumnist($nombre, $profesion, $descripcion);

                for ($i = 0; $i <count($imagenes['tmp_name']); $i++) {
                    $nombreTemporal = $imagenes['tmp_name'][$i];
                    $nombreOriginal = $imagenes['name'][$i];
                    $path = "img/profile/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                    $this->modelImage->insertImage($idColumnist, $path);
                    move_uploaded_file($nombreTemporal, $path);
                }
                header('Location: ' . BASE_URL . 'admin');
            }
        } else{
            $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
        } 
    }

   public function deleteColumnist($idColumnist){
        //Rescatamos la dirección del archivo antes de eliminarlo
        $paths = $this->modelImage->getPathColumnist($idColumnist);

        $success = $this->modelColumnists->deleteColumnist($idColumnist);    

        if ($success){
            foreach ($paths as $path){;
                unlink($path->path);
                header('Location: ' . BASE_URL . 'admin');
            }     
        }
        else {
            $this->viewMessage->showError("Debes eliminar todos los podcasts de este columnista previamente"); 
        }
   }

   public function editColumnist($idColumnist){

        $old = $this->modelColumnists->getColumnist($idColumnist);
        $images = $this->modelImage->getImages($idColumnist);
        $this->view->showEditColumnist($old,$images);
   }

   public function updateColumnist($idColumnist){
   
        $nombre = $_POST['nombre'];
        $profesion = $_POST['profesion'];
        $descripcion = $_POST['descripcion'];
        $imagenes = $_FILES;
        $old_url = $_POST['old_url'];
        $index = 0; // Indíce que indica el nro de iteración del foreach
        

        if (!empty($nombre) && !empty($profesion) &&  !empty($descripcion)) {

            $success = $this->modelColumnists->updateColumnist($idColumnist, $nombre, $profesion, $descripcion);
            
            foreach ($imagenes as $imagen){
                $url_imagen = $old_url[$index];
            
                if ($imagen['error'] != 4){
                    $nombreOriginal =  $imagen['name'];
                    $nombreTemporal = $imagen['tmp_name'];
                    $tipoArchivo = $imagen['type'];
                    $isValid = $this->isValidType($tipoArchivo, 'image');
        
                    if ($isValid){
                        unlink($url_imagen);
                        $url_imagen = "img/profile/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                        move_uploaded_file($nombreTemporal, $url_imagen);
                    } else{
                       /*Habría que hacer algo si alguna de las imagenes que ingresaron no es de un formato valido, 
                        pero hay que validar el conjunto de imagenes antes de empezar 
                        con su administración una por una. Va en el próximo release :D  */
                    }     
                }
                $this->modelImage->insertImage($idColumnist, $url_imagen);
                $index++; 
            }
            header('Location: ' . BASE_URL . 'admin');
            
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos o archivos obligatorios"); 
        }
   }

    public function addPodcast(){

        // toma los valores enviados por el usuario
        $nombre = $_POST['nombre'];
        $columnista = $_POST['columnista'];
        $descripcion = $_POST['descripcion'];
        $audio = $_FILES ['audio'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $etiqueta = $_POST['etiqueta'];
        $invitado = $_POST['invitado'];

        //Datos del archivo ingresado
        
        $nombreOriginal =  $_FILES ['audio']['name'];
        $nombreTemporal = $_FILES ['audio']['tmp_name'];
        $tipoArchivo = $_FILES['audio']['type'];
        $isValid = $this->isValidType($tipoArchivo, 'audio');
        
        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($columnista) &&  !empty($descripcion) && !empty($audio) && !empty($fecha) && !empty($duracion) && !empty($etiqueta)) {
            // inserta en la DB y redirige

            if ($isValid){
                $nombreFinal = "audio/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                $success = $this->modelPodcasts->insertPodcast($nombre, $columnista, $descripcion, $nombreFinal, $fecha, $duracion, $etiqueta, $invitado);
                
                if ($success){
                move_uploaded_file($nombreTemporal, $nombreFinal);
                header('Location: ' . BASE_URL . 'admin');
                }
                else{
                    $this->viewMessage->showError("ERROR! Falló la carga del podcast"); 
                } 
            }
            else{
                $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
            }
            
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
    }

    public function editPodcast($idPodcast){

        $old = $this->modelPodcasts->getPodcast($idPodcast);
        $listColumnists = $this->modelColumnists->getAll(); 

        $this->view->showEditPodcast($old,$listColumnists);
    }

    public function updatePodcast($idPodcast){

        $nombre = $_POST['nombre'];
        $columnista = $_POST['columnista'];
        $descripcion = $_POST['descripcion'];
        $audio = $_FILES['audio'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $etiqueta = $_POST['etiqueta'];
        $invitado = $_POST['invitado'];
        $url_audio = $_POST['old_audio']; // URL que se mantendrá si el usuario no cargó un nuevo archivo

        // verifica los datos obligatorios
        if (!empty($nombre) && !empty($columnista) &&  !empty($descripcion) && !empty($fecha) && !empty($duracion) && !empty($etiqueta)) {
            
            if ($audio['error'] != 4){

                $nombreOriginal =  $_FILES ['audio']['name'];
                $nombreTemporal = $_FILES ['audio']['tmp_name'];
                $tipoArchivo = $_FILES['audio']['type'];
                $isValid = $this->isValidType($tipoArchivo, 'audio');

                if ($isValid){
                    unlink($url_audio);
                    $url_audio = "audio/" . uniqid("", true) . "." . strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
                    move_uploaded_file($nombreTemporal, $url_audio);
                } else{
                    $this->viewMessage->showError("ERROR! Tipo de archivo no soportado"); 
                }     
            }

            $success = $this->modelPodcasts->updatePodcast($idPodcast, $nombre, $columnista, $descripcion, $url_audio, $fecha, $duracion, $etiqueta, $invitado);
            if ($success){
                header('Location: ' . BASE_URL . 'admin');
            } else{
                $this->viewMessage->showError("ERROR! Falló la carga del podcast"); 
            } 
        } else {
            $this->viewMessage->showError("ERROR! Faltan datos obligatorios"); 
        }
    }

    public function deletePodcast($idPodcast){

        //Rescatamos la dirección del archivo antes de eliminarlo
        $path = $this->modelPodcasts->getPathPodcast($idPodcast)->url_audio;

        //Pasamos como segundo parámetro la dirección para borrarlo de nuestro repositorio ademas de la DB
        $this->modelPodcasts->deletePodcast($idPodcast, $path);
        header('Location: ' . BASE_URL . 'admin');
    }

    public function viewPodcasts($idColumnist){
        
        $podcasts = $this->modelPodcasts->getPodcasts($idColumnist);
        $listColumnists = $this->modelColumnists->getAll();
        $nameColumnist = $this->modelColumnists->getNameColumnist($idColumnist)->nombre;
        $this->view->showAdminPodcasts($podcasts, $listColumnists, $nameColumnist);
    }

    public function viewUsers(){
        $users = $this->modelUser->getUsers();
        $this->view->showAdminUsers($users);
    }
     
    public function deleteUser($id_user){
        $success = $this->modelUser->deleteUser($id_user);
        header('Location: ' . BASE_URL . 'admin/users/view');
    }

    public function updateUserPrivileges($id_user, $esAdmin){
        if (empty($esAdmin)){
            $esAdmin = "1";
        }else{
            $esAdmin = "0";
        }
        $success = $this->modelUser->updateUserPrivileges($id_user, $esAdmin);
        if ($success){
            header('Location: ' . BASE_URL . 'admin/users/view');
        } else{
            $this->viewMessage->showError("ERROR! Falló la actualizacion de privilegios"); 
        } 
    }

    private function isValidType($fileType, $validFormat) {

        switch ($validFormat) {
            case 'audio':
                if ($fileType == "audio/ogg" || $fileType == "audio/mpeg"){
                    return true;
                }else{
                    return false;
                }
                break;
            
            case 'image':
                if ($fileType == "image/gif" || $fileType == "image/jpg" ||
                    $fileType == "image/png" || $fileType == "image/jpeg"){
                    return true;
                }else{
                    return false;
                }
            break;
        }
        
    } 

    public function isValidTypeAll($imagenes, $validFormat){

        foreach($imagenes["type"] as $key => $type){
              if (!$this->isValidType($type, $validFormat)){ // Si esa imagen no es de un formato valido
                  return false;
              }
        }
        return true;
    }

}