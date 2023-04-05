<?php
session_start();

interface IRecord
{
    public function addRecord(Records $record);
    public function getRecord($recordId);
    public function deleteRecord($recordId);
    public function getAllRecords();

    public function confirm($id);

    public function payPenalty($id,$amount);

}


class RecordService Implements IRecord {

    public function addRecord(Records $record)
    {
        try {
            $conn = getCon();

            $isbn=$record->getIsbn();
            $user=$record->getUserId();
            $bDate=$record->getBDate();
            $dDate=$record->getDDate();

            $query = "INSERT INTO `records`(`book_id`, `borrower_id`, `borrow_date`, `due_date`) 
                        VALUES (?,?,?,?)";

            $st = $conn->prepare($query);
            $st->bindValue(1, $isbn, PDO::PARAM_STR);
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

    public function getRecord($recordId)
    {
        // TODO: Implement getRecord() method.
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

    public function getAllRecords()
    {
        // TODO: Implement getAllRecords() method.
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
}