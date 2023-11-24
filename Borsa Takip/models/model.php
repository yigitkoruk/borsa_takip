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

    public function hisseSat($id)
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
            $stmt = $this->connect->prepare("INSERT INTO gunluk_hisse (hisse_id, alis_maliyeti, guncel_fiyat, adet, kar_zarar, ay) VALUES (:value1, :value2, :value3, :value4, :value5, :value6)");
            $stmt->bindParam(':value1', $hisseBilgisi['value1']);
            $stmt->bindParam(':value2', $hisseBilgisi['value2']);
            $stmt->bindParam(':value3', $hisseBilgisi['value3']);
            $stmt->bindParam(':value4', $hisseBilgisi['value4']);
            $stmt->bindParam(':value5', $hisseBilgisi['value5']);
            $stmt->bindParam(':value6', $hisseBilgisi['value6']);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function toplamGunlukKarZarar($hisseBilgisi)
    {
        try {
            $stmt = $this->connect->prepare("INSERT INTO toplam_gunluk_karzarar (kar_Zarar, tarih, ay) VALUES (:value1, :value2, :value3)");
            $stmt->bindParam(':value1', $hisseBilgisi['value1']);
            $stmt->bindParam(':value2', $hisseBilgisi['value2']);
            $stmt->bindParam(':value3', $hisseBilgisi['value3']);
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

    public function hisseDetay($id)
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

    public function hisseGuncelleme($id, $hisseBilgisi)
    {
        try {
            $stmt = $this->connect->prepare("UPDATE hisseler SET hisse_adi = :value1, alis_maliyeti = :value2, guncel_fiyat = :value3, adet = :value4, kar_zarar = :value5 WHERE id = :id");
            $stmt->bindParam(':id', $id);
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

    public function gunlukKarZarar()
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM toplam_gunluk_karzarar");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function hisseKarZarar($id)
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM gunluk_hisse WHERE hisse_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function aylıkKarZarar($hisseBilgisi)
    {
        try {
            $stmt = $this->connect->prepare("INSERT INTO aylık_karzarar (kar_Zarar) VALUES (:value1)");
            $stmt->bindParam(':value1', $hisseBilgisi['value1']);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function aylikKarZararTablosu()
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM aylık_karzarar ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function aylıkHesaplama($ay)
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM toplam_gunluk_karzarar WHERE ay = :ay");
            $stmt->bindParam(':ay', $ay);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function aylıkKarZararListe()
    {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM aylık_karzarar");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
}
