<?php

class model
{
    private $host = 'localhost';
    private $dbname = 'borsa_takip';
    private $username = 'root';
    private $password = '';

    public $connect;

    public function __construct()
    {
        try {
            $this->connect = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function hisseList()
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM hisseler WHERE islem_durumu = true");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
    
    public function hisseEkleme($hisseBilgisi)
    {
        try {
            $stmt = $this->connect->prepare("INSERT INTO hisseler (hisse_adi, alis_maliyeti, guncel_fiyat, adet, kar_zarar) VALUES (:value1, :value2, :value3, :value4, :value5)");
            $stmt->bindParam(':value1', $hisseBilgisi['value1']);
            $stmt->bindParam(':value2', $hisseBilgisi['value2']);
            $stmt->bindParam(':value3', $hisseBilgisi['value3']);
            $stmt->bindParam(':value4', $hisseBilgisi['value4']);
            $stmt->bindParam(':value5', $hisseBilgisi['value5']);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function hisseGuncelleme($id)
    {
        try {
            $stmt = $this->connect->prepare("UPDATE hisseler SET islem_durumu = False WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function gunlukHisse($hisseBilgisi)
    {
        try {
            $stmt = $this->connect->prepare("INSERT INTO gunluk_hisse (hisse_id, alis_maliyeti, guncel_fiyat, adet, kar_zarar) VALUES (:value1, :value2, :value3, :value4, :value5)");
            $stmt->bindParam(':value1', $hisseBilgisi['value1']);
            $stmt->bindParam(':value2', $hisseBilgisi['value2']);
            $stmt->bindParam(':value3', $hisseBilgisi['value3']);
            $stmt->bindParam(':value4', $hisseBilgisi['value4']);
            $stmt->bindParam(':value5', $hisseBilgisi['value5']);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function karZarar()
    {
        try {
            $stmt = $this->connect->prepare("SELECT kar_zarar FROM `toplam_gunluk_karzarar` ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function toplamGunlukKarZarar($hisseBilgisi)
    {
        try {
            $stmt = $this->connect->prepare("INSERT INTO toplam_gunluk_karzarar (kar_Zarar, tarih) VALUES (:value1, :value2)");
            $stmt->bindParam(':value1', $hisseBilgisi['value1']);
            $stmt->bindParam(':value2', $hisseBilgisi['value2']);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function gunlukHisse2()
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM gunluk_hisse ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function hisseler($id)
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM hisseler WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
}
