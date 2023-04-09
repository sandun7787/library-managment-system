<?php
session_start();

interface IReservation
{
    public function addReservation(Reservation $reservation);
    public function changeReservationState($reservationId, $state);
    public function getReservationSet();
    public function getFilteredReservationSet();
    public function getOldReservationSet();
    public function getFilteredOldReservationSet();
    public function getMyReservations();
    public function getFilteredMyReservations();
    public function deleteReservation($reservationId);
    public function getReservationsToArray($id);

}

class ReservationService implements IReservation
{

    public function addReservation(Reservation $reservation)
    {
        try {
            $conn = getCon();

            $bookId = $reservation->getBookId();
            $userId = $reservation->getUserId();
            $resDate = $reservation->getReservationDate();
            $reqDate = $reservation->getRequestedDate();

            $query = "INSERT INTO `reservation`( `bookId`, `userId`, `date`, `reqDate`) 
            VALUES (?,?,?,?)";

            $st = $conn->prepare($query);
            $st->bindValue(1, $bookId, PDO::PARAM_STR);
            $st->bindValue(2, $userId, PDO::PARAM_STR);
            $st->bindValue(3, $resDate, PDO::PARAM_STR);
            $st->bindValue(4, $reqDate, PDO::PARAM_STR);
            $st->execute();

            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }

    public function changeReservationState($reservationId, $state)
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

    public function getReservationSet()
    {
        $conn = getCon();
        $query = "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state, reservation.userId, reservation.bookId
                FROM reservation 
                JOIN book ON book.bookId = reservation.bookId 
                WHERE reservation.state IN ('pending', 'accepted')
                ORDER BY 
                  CASE reservation.state 
                    WHEN 'pending' THEN 1 
                    WHEN 'accepted' THEN 2 
                  END, 
                  reservation.date DESC;";
        return $conn->query($query);
    }

    public function getFilteredReservationSet()
    {
        $conn = getCon();
        $query = "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state, reservation.userId, reservation.bookId
                    FROM reservation 
                    JOIN book ON book.bookId = reservation.bookId 
                    WHERE reservation.state IN ('pending', 'accepted') AND book.name LIKE '{$_POST['query']}%'
                    ORDER BY 
                      CASE reservation.state 
                        WHEN 'pending' THEN 1 
                        WHEN 'accepted' THEN 2 
                      END, 
                      reservation.date DESC;";
        return $conn->query($query);
    }

    public function getOldReservationSet()
    {
        $conn = getCon();
        $query = "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state, reservation.userId, reservation.bookId
                FROM reservation 
                JOIN book ON book.bookId = reservation.bookId 
                WHERE reservation.state IN ('completed', 'rejected')
                ORDER BY 
                  CASE reservation.state 
                    WHEN 'completed' THEN 1 
                    WHEN 'rejected' THEN 2 
                  END, 
                  reservation.date DESC;";
        return $conn->query($query);
    }

    public function getFilteredOldReservationSet()
    {
        $conn = getCon();
        $query = "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state, reservation.userId, reservation.bookId
                FROM reservation 
                JOIN book ON book.bookId = reservation.bookId 
                WHERE reservation.state IN ('completed', 'rejected') AND book.name LIKE '{$_POST['query']}%'
                ORDER BY 
                  CASE reservation.state 
                    WHEN 'completed' THEN 1 
                    WHEN 'rejected' THEN 2 
                  END, 
                  reservation.date DESC;";
        return $conn->query($query);
    }

    public function getMyReservations()
    {
        $conn = getCon();
        $query ="SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state
                    FROM reservation 
                    JOIN book ON book.bookId = reservation.bookId 
                    WHERE reservation.userId = '9563' 
                    ORDER BY 
                      CASE reservation.state 
                        WHEN 'pending' THEN 1 
                        WHEN 'accepted' THEN 2 
                        WHEN 'rejected' THEN 3 
                        WHEN 'completed' THEN 4 
                      END;
                    ";
        return $conn->query($query);
    }

    public function getFilteredMyReservations()
    {
        $conn = getCon();
        $query ="SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state
                    FROM reservation 
                    JOIN book ON book.bookId = reservation.bookId 
                    WHERE reservation.userId = '9563' AND book.name LIKE '{$_POST['query']}%'
                    ORDER BY 
                      CASE reservation.state 
                        WHEN 'pending' THEN 1 
                        WHEN 'accepted' THEN 2 
                        WHEN 'rejected' THEN 3 
                        WHEN 'completed' THEN 4 
                      END;
                    ";
        return $conn->query($query);
    }

    public function deleteReservation($reservationId)
    {
        try {
            $conn = getCon();
            $query = "DELETE FROM `reservation` WHERE `id` =$reservationId";
            $st = $conn->query($query);
            $st->execute();
            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }    }

    public function getReservationsToArray($id)
    {
        $conn = getCon();
        $query =  "SELECT `id` FROM `reservation` WHERE  `bookId` =$id ";
        return $conn->query($query);
    }
}