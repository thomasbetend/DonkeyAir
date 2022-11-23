<?php

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
require('./View/ReservationsListView.class.php');

require('./Controller/HomeController.class.php');
require('./Controller/ReservationsController.class.php');
require('./Controller/UserController.class.php');
require('./Controller/CartController.class.php');
require('./Controller/FlightsController.class.php');
require('./Controller/CalendarController.class.php');
require('./Controller/ErrorController.class.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$split= explode("/", $uri);

if('/flight-test-date' != '/' . $split[1]){
    include_once('./header.php');
}

if ('/accueil' === $uri || '/index.php' === $uri) {
    HomeController::home();
}

elseif ('/connexion' === $uri) {
    UserController::getLogin();
}

elseif ('/deconnexion' === $uri) {
    Session::destroy();
    UserController::getLogout();
}

elseif ('/inscription' === $uri) {
    UserController::getSignup();
}

elseif ('/reservations' === '/' . $split[1]) {
    Security::isloggedIn($_SESSION);
    if (!preg_match("/^[0-9]+$/", $split[2])){
        echo "<h4 class='text-center mt-4'>erreur</h4>";
    } else {
        ReservationsController::getList($split[2]);
    }
}

elseif ('/reservation-validation' === '/' . $split[1]) {
    Security::isloggedIn($_SESSION);

    if (!preg_match("/^[0-9]+$/", $split[2])){
        echo "<h4 class='text-center mt-4'>erreur</h4>";
    } else {
        ReservationsController::getValidation($split[2]);
    }
}

elseif ('/reservation-impossible' == $uri){
    ReservationsController::impossible();
}

elseif ('/reservation-details' === '/' . $split[1]){
    Security::isloggedIn($_SESSION);

    if (!preg_match("/^[0-9]+$/", $split[2])){
        echo "<h4 class='text-center mt-4'>erreur</h4>";
    } else {
        ReservationsController::getDetails($split[2]);
    }
}

elseif ('/reservation-acceptee' == $uri){
    Security::isloggedIn($_SESSION);
    ReservationsController::success();
}

elseif ('/panier' === $uri) {
    CartController::getList();
}

elseif ('/panier/valide' === $uri) {
    Security::isloggedIn($_SESSION);
    CartController::validate();
}

elseif ('/panier-suppression' === '/' . $split[1]){
    Security::isloggedIn($_SESSION);
    CartController::delete($split[2]);
}

elseif ('/vol-complet' == $uri){
    Security::isloggedIn($_SESSION);
    ReservationsController::full();
}

elseif ('/ajouter-vol' == $uri){
    Security::isloggedInAdmin($_SESSION);
    FlightsController::add();
}

elseif ('/vol-ajoute' == '/'.$split[1]){
    Security::isloggedInAdmin($_SESSION);

    if(empty($split[2]) || !is_int(intval($split[2]))){
        ErrorRepository::toErrorPage();
    }
    FlightsController::addSuccess($split[2]);
}

elseif ('/calendrier' === $uri){
    CalendarController::calendar();
}

elseif ('/date' == '/' . $split[1]){
    //var_dump($split); die;

    if (empty($split[2]) || empty($split[3]) || empty($split[4]) || !preg_match("/^[0-9]{1,4}$/", $split[4])){
        echo "<h4 class='text-center mt-4'>erreur</h4>";
    } else {
        FlightsController::getDateFlights($split[2], $split[3], $split[4]);
    }

}

elseif ('/flight-test-date' == '/' . $split[1]){

    if (empty($split[2]) || empty($split[3]) || empty($split[4]) || !preg_match("/^[0-9]{1,4}$/", $split[4])){
        echo "<h4 class='text-center mt-4'>erreur</h4>";
    } else {

        CalendarController::getMatchCalendar($split[2], $split[3], $split[4]);

    }
}

elseif ('/erreur' === $uri){
    echo "<h4 class='text-center mt-4'>erreur</h4>";
}

else {
    HomeController::home();
}

if('/flight-test-date' != '/' . $split[1]){
    include_once('./footer.php');
}



