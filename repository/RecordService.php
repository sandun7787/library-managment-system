<?php
session_start();

interface IRecord
{
    public function addRecord(Records $record);
    public function deleteRecord($recordId);
    public function confirm($id);
    public function payPenalty($id,$amount);
    public function getAllPendingRecords();
    public function getAllFilteredPendingRecords();
    public function getOldRecords();
    public function getFilteredOldRecords();
    public function getPenaltyRecords();
    public function getFilteredPenaltyDetails();
    public function getOldPenaltyRecords();
    public function getFilteredOldPenaltyRecords();


}


class RecordService Implements IRecord {

    public function addRecord(Records $record)
    {
        try {
            $conn = getCon();

            $bookId=$record->getBookId();
            $user=$record->getUserId();
            $bDate=$record->getBDate();
            $dDate=$record->getDDate();

            $query = "INSERT INTO `records`(`book_id`, `borrower_id`, `borrow_date`, `due_date`) 
                        VALUES (?,?,?,?)";

            $st = $conn->prepare($query);
            $st->bindValue(1, $bookId, PDO::PARAM_STR);
            $st->bindValue(2, $user, PDO::PARAM_STR);
            $st->bindValue(3, $bDate, PDO::PARAM_STR);
            $st->bindValue(4, $dDate, PDO::PARAM_STR);
            $st->execute();

            return 1;
        }
        catch(SQLiteException $ex){
            return 0;
        }
    }

    public function deleteRecord($recordId)
    {
        try {
            $conn = getCon();
            $query = "DELETE FROM `records` WHERE `id` =$recordId";
            $st= $conn->query($query);
            $st->execute();
            return 1;
        }
        catch(SQLiteException $ex){
            return 0;
        }
    }

    public function confirm($id)
    {
        try {
            $conn = getCon();
            $date_now = date("Y-m-d");
            $query = "UPDATE `records` SET `return_date`=? WHERE `id` = $id";

            $st = $conn->prepare($query);
            $st->bindValue(1, $date_now, PDO::PARAM_STR);
            $st->execute();

            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }

    public function payPenalty($id, $amount)
    {
        try {
            $conn = getCon();
            $query = "UPDATE `records` SET `penalty`=? WHERE `id` = $id";
            $st = $conn->prepare($query);
            $st->bindValue(1, $amount, PDO::PARAM_STR);
            $st->execute();
            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }

    public function getAllPendingRecords()
    {
        $conn = getCon();
        $query =  "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE return_date IS NULL ORDER BY due_date ASC ";
        return $conn->query($query);
    }

    public function getAllFilteredPendingRecords()
    {
        $conn = getCon();
        $query =  "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE return_date IS NULL AND borrower_id LIKE '{$_POST['query']}%' LIMIT 100";
        return $conn->query($query);
    }

    public function getOldRecords()
    {
        $conn = getCon();
        $query =  "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE return_date IS NOT NULL ORDER BY due_date ASC ";
        return $conn->query($query);
    }

    public function getFilteredOldRecords()
    {
        $conn = getCon();
        $query = "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE return_date IS NOT NULL AND borrower_id LIKE '{$_POST['query']}%' LIMIT 100";
        return $conn->query($query);
    }

    public function getPenaltyRecords()
    {
        $conn = getCon();
        $query = "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE return_date IS NULL AND penalty IS NULL AND NOW() > due_date ORDER BY due_date ASC ";
        return $conn->query($query);
    }

    public function getFilteredPenaltyDetails()
    {
        $conn = getCon();
        $query = "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE return_date IS NULL AND penalty IS NULL AND
                    NOW() > due_date AND borrower_id LIKE '{$_POST['query']}%' LIMIT 100";
        return $conn->query($query);
    }

    public function getOldPenaltyRecords()
    {
        $conn = getCon();
        $query = "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty`
                    FROM `records` WHERE  penalty IS NOT NULL AND NOW() > due_date ORDER BY due_date ASC ";
        return $conn->query($query);    }

    public function getFilteredOldPenaltyRecords()
    {
        $conn = getCon();
        $query ="SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` 
                    FROM `records` WHERE  penalty IS NOT NULL AND NOW() > due_date 
                    AND borrower_id LIKE '{$_POST['query']}%' LIMIT 100";
        return $conn->query($query);    }
}