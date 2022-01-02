<?php
/* 
 *  ..:: ENGLISH ::..
 *  © 2017 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement and Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */
class Database
{
    protected $_protect_identifiers        = TRUE;
    private $host = DB_HOST;
    private $datebase = DB_DATABASE;
    private $user = DB_USER;
    private $password = DB_PW;
    protected $conn;

    public function __construct()
    { //açılışta çalıştır


        $this->dbBaglantiKur();
    }



    public function dbBaglantiKur()
    { //veritabanı bağlantısı kurma

        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->datebase",  $this->user, $this->password);

            $this->conn->query("SET NAMES 'utf8'");

            $this->conn->query('set character set utf8');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die(_("Database connection failed!"));
        }
    }






    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {

        $sth = $this->conn->prepare($sql);

        foreach ($array as $key => $value) {

            $sth->bindValue($key, $value);
        }

        $sth->execute();

        return $sth->fetchAll($fetchMode);
    }


    public function search($aranan, $limit = "")
    { //kayıtlarda arama yapma
        $bul = Filitre::tag($aranan);
        if (isset($limit) and !empty($limit))
            $bul = $this->conn->prepare('SELECT id,baslik,sefurl FROM basliklar WHERE durum=1 and baslik LIKE ? order by hit LIMIT ' . $limit . ' ');
        else $bul = $this->conn->prepare('SELECT id,baslik,sefurl FROM basliklar WHERE durum=1 and durum=1 and tasindi=1 baslik LIKE ? order by hit');

        $bul->execute(array('%' . $aranan . '%'));

        return $bul->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->conn->prepare($sql);
        foreach ($array as $key => $value) {

            $sth->bindValue($key, '%' . $value . '%');
        }

        $sth->execute();

        return $sth->fetchAll($fetchMode);
    }

    public function row($sql, $array = array())
    {

        $sth = $this->conn->prepare($sql);

        foreach ($array as $key => $value) {

            $sth->bindValue($key, $value);
        }


        $sth->execute();

        return $sth->rowCount();
    }



    public function insert($tableName, $data)
    {

        $fieldKeys = implode(",", array_keys($data));

        $fieldValues = ":" . implode(", :", array_keys($data));



        $sql = "INSERT INTO $tableName($fieldKeys) VALUES($fieldValues)";

        $sth = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {

            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        $iii =  $this->conn->lastInsertId();
        return $iii;
    }



    public function update($tableName, $where, $data)
    {

        $updateKeys = null;

        foreach ($data as $key => $value) {

            $updateKeys .= "$key=:$key,";
        }

        $updateKeys = rtrim($updateKeys, ",");

        $sql = "UPDATE $tableName SET $updateKeys WHERE $where";

        $sth = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {

            $sth->bindValue(":$key", $value);
        }

        return $sth->execute();
    }



    public function delete($table, $id, $limit = 1)
    {

        $sil = $this->conn->prepare('DELETE FROM ' . $table . ' WHERE ' . $id . ' ');

        return $sil->execute(array($id));
    }
    public function offline($table, $id, $limit = 1)
    {

        $sil = $this->conn->prepare('DELETE FROM ' . $table . ' WHERE time<?');

        return $sil->execute(array($id));
    }
    public function doldurbosalt($table)
    {

        $sil = $this->conn->prepare('TRUNCATE TABLE ' . $table . ' ') or die("0");

        return $sil->execute();
    }
}
