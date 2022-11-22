<?php 

include_once('./header.php');

require('./Connection/Database.class.php');

require('./Security/ErrorRepository.class.php');
require('./Security/Security.class.php');

require('./Model/Flight.class.php');
require('./Model/User.class.php');
require('./Model/Reservation.class.php');
require('./Model/Airport.class.php');
require('./Model/ReservationFlight.class.php');

require('./Repositories/AirportRepository.class.php');
require('./Repositories/ReservationFlightRepository.class.php');
require('./Repositories/ReservationRepository.class.php');
require('./Repositories/UserRepository.class.php');
require('./Repositories/FlightRepository.class.php');

require('./View/FlightsListView.class.php');
require('./View/PromosListView.class.php');
require('./View/ReservationFlightsListView.class.php');

require('./Controller/Main.class.php');
require('./Controller/ReservationsController.class.php');
require('./Controller/UserController.class.php');
require('./Controller/CartController.class.php');
require('./Controller/FlightsController.class.php');


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$split= explode("/", $uri);

//var_dump($split); die;

if ('/accueil' === $uri) {
    Main::home();
}

if ('/reservations' === $uri) {
    ReservationsController::getList();
}

if ('/connexion' === $uri) {
    UserController::getLogin();
}

if ('/deconnexion' === $uri) {
    Session::destroy();
    UserController::getLogout();
}

if ('/inscription' === $uri) {
    UserController::getSignup();
}

if ('/reservation-validation' === '/'.$split[1]) {
    ReservationsController::getValidation($split[2]);
}

if ('/panier' === $uri) {
    CartController::getList();
}

if('/panier-suppression' === '/'.$split[1]){
    CartController::delete($split[2]);
}

if('/reservation-details' === '/'.$split[1]){
    ReservationsController::getDetails($split[2]);
}

if('/calendrier' === $uri){
    Main::calendar();
}

if('/reservation-impossible' == $uri){
    ReservationsController::impossible();
}

if('/vol-complet' == $uri){
    ReservationsController::full();
}

if('/reservation-acceptee' == $uri){
    ReservationsController::success();
}

if('/ajouter-vol' == $uri){
    FlightsController::add();
}

if('/vol-ajoute' == $uri){
    FlightsController::addSucess();
}

include_once('./footer.php');



