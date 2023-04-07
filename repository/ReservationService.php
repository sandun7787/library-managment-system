<?php
session_start();

interface IReservation
{
    public function addReservation(Reservation $reservation);
    public function getReservation($reservationId);
    public function deleteReservation($reservationId);
    public function getAllReservations();
    public function changeReservationState($reservationId,$state);

}
class ReservationService implements IReservation {

    public function addReservation(Reservation $reservation)
    {
        try {
            $conn = getCon();

            $bookId=$reservation->getBookId();
            $userId=$reservation->getUserId();
            $resDate=$reservation->getReservationDate();
            $reqDate=$reservation->getRequestedDate();

            $query = "INSERT INTO `reservation`( `bookId`, `userId`, `date`, `reqDate`) 
            VALUES (?,?,?,?)";

            $st = $conn->prepare($query);
            $st->bindValue(1, $bookId, PDO::PARAM_STR);
            $st->bindValue(2, $userId, PDO::PARAM_STR);
            $st->bindValue(3, $resDate, PDO::PARAM_STR);
            $st->bindValue(4, $reqDate, PDO::PARAM_STR);
            $st->execute();

            return 1;
        }
        catch(SQLiteException $ex){
            return 0;
        }
    }

    public function getReservation($reservationId)
    {
        // TODO: Implement getReservation() method.
    }

    public function deleteReservation($reservationId)
    {
        // TODO: Implement deleteReservation() method.
    }

    public function getAllReservations()
    {
        // TODO: Implement getAllReservations() method.
    }

    public function changeReservationState($reservationId,$state)
    {
        try {
            $conn = getCon();
            $query = "UPDATE `reservation` SET `state`=? WHERE `id` = $reservationId";
            $st = $conn->prepare($query);
            $st->bindValue(1, $state, PDO::PARAM_STR);
            $st->execute();
            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }
}