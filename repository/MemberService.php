<?php
session_start();

interface IMember
{
    public function addDetails(Member $member);
    public function getMember($member);
    public function updateMember(Memeber $member);
    public function ChangeStatus($memberId,$state);
    public function getAllMember();
    public function getFilteredMembers();

}

class MemberService implements IMember{

    public function addDetails(Member $member)
    {
        try {
            $conn = getCon();
            $id=$member->getMemberId();
            $name=$member->getName();
            $email=$member->getEmail();
            $number=$member->getNo();
            $img=$member->getImgUrl();
            $password=$member->getPassword();


            $query = "INSERT INTO `member`(`id`, `name`, `email`, `no`, `state`, `password`, `imgUrl`)
                        VALUES (?,?,?,?,?,?,?)";

            $st = $conn->prepare($query);

            $st->bindValue(1, $id, PDO::PARAM_STR);
            $st->bindValue(2, $name, PDO::PARAM_STR);
            $st->bindValue(3, $email, PDO::PARAM_STR);
            $st->bindValue(4, $number, PDO::PARAM_STR);
            $st->bindValue(5, "active", PDO::PARAM_STR);
            $st->bindValue(6, $password, PDO::PARAM_STR);
            $st->bindValue(7, $img, PDO::PARAM_STR);
            $st->execute();

            return 1;
        }
        catch(SQLiteException $ex){
            return 0;
        }
    }





    public function getMember($member)
    {
        // TODO: Implement getMember() method.
    }

    public function updateMember(Memeber $member)
    {
        // TODO: Implement updateMember() method.
    }

    public function ChangeStatus($memberId,$state)
    {
        try {
            $conn = getCon();
            $query = "UPDATE `member` SET `state`=? WHERE `id` = $memberId";

            $st = $conn->prepare($query);
            $st->bindValue(1, $state, PDO::PARAM_STR);
            $st->execute();

            return 1;
        } catch (SQLiteException $ex) {
            return 0;
        }
    }


    public function getAllMember()
    {
        $conn = getCon();
        $query = "SELECT `id`, `name`, `email`, `no`, `state`, `password`, `imgUrl` FROM `member` ORDER BY `state` ASC";
        return $conn->query($query);
    }

    public function getFilteredMembers()
    {
        $conn = getCon();
        $query = "SELECT `id`, `name`, `email`, `no`, `state`, `password`, `imgUrl` FROM `member` WHERE name LIKE '{$_POST['query']}%' LIMIT 100";
        return $conn->query($query);
    }
}
