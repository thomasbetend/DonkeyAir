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
require('./Model/Promos.class.php');

require('./Repositories/AirportRepository.class.php');
require('./Repositories/ReservationFlightRepository.class.php');
require('./Repositories/ReservationRepository.class.php');
require('./Repositories/UserRepository.class.php');
require('./Repositories/FlightRepository.class.php');

require('./View/FlightsListView.class.php');
require('./View/PromosListView.class.php');
require('./View/ReservationFlightsListView.class.php');

require('./Controller/HomeController.class.php');
require('./Controller/ReservationsController.class.php');
require('./Controller/UserController.class.php');
require('./Controller/CartController.class.php');
require('./Controller/FlightsController.class.php');
require('./Controller/CalendarController.class.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$split= explode("/", $uri);

//var_dump($split); die;

if ('/accueil' === $uri || '/index.php' === $uri) {
    HomeController::home();
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

if ('/reservations' === '/' . $split[1]) {
    Security::isloggedIn($_SESSION);
    ReservationsController::getList($split[2]);
}

if ('/reservation-validation' === '/' . $split[1]) {
    Security::isloggedIn($_SESSION);
    ReservationsController::getValidation($split[2]);
}

if('/reservation-impossible' == $uri){
    ReservationsController::impossible();
}

if('/reservation-details' === '/' . $split[1]){
    Security::isloggedIn($_SESSION);
    ReservationsController::getDetails($split[2]);
}

if('/reservation-acceptee' == $uri){
    Security::isloggedIn($_SESSION);
    ReservationsController::success();
}

if ('/panier' === $uri) {
    CartController::getList();
}

if ('/panier/valide' === $uri) {
    Security::isloggedIn($_SESSION);
    CartController::validate();
}

if('/panier-suppression' === '/' . $split[1]){
    Security::isloggedIn($_SESSION);
    CartController::delete($split[2]);
}

if('/vol-complet' == $uri){
    Security::isloggedIn($_SESSION);
    ReservationsController::full();
}

if('/ajouter-vol' == $uri){
    Security::isloggedInAdmin($_SESSION);
    FlightsController::add();
}

if('/vol-ajoute' == '/'.$split[1]){
    Security::isloggedInAdmin($_SESSION);
    FlightsController::addSuccess($split[2]);
}

if('/calendrier' === $uri){
    Security::isloggedIn($_SESSION);
    CalendarController::calendar();
}

if('/date' == '/' . $split[1]){
    Security::isloggedIn($_SESSION);
    FlightsController::getDateFlights($split[2], $split['3'], $split['4']);
}

include_once('./footer.php');



