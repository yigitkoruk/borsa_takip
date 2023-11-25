<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borsa Takip</title>
</head>

<body>
    <h2>Borsa Bilgi Çekme</h2>

    <form action="" method="post">
        <label for="stockSymbol">Hisse Adı:</label>
        <input type="text" id="stockSymbol" name="stockSymbol" required>
        <button type="submit">Bilgiyi Getir</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kullanıcının girdiği hisse adını al
        $stockSymbol = $_POST["stockSymbol"];

        // Formdan gelen veriyi içeren URL'yi oluştur
        $url = "https://www.google.com/finance/quote/{$stockSymbol}:IST?hl=tr";

        // Formdan gelen veriyi içeren HTML'i çek
        $html = file_get_contents($url);

        // DOMDocument ile HTML'i işlemeden önce uygun hale getirme
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        // XPath nesnesini oluştur
        $xpath = new DOMXPath($dom);

        // data-currency-code ve data-last-price değerlerini al
        $currencyCode = $xpath->query('//div[@data-currency-code]')->item(0)->getAttribute('data-currency-code');
        $lastPrice = $xpath->query('//div[@data-last-price]')->item(0)->getAttribute('data-last-price');

        // İstenilen veriyi ekrana yazdır
        echo "<h3>$stockSymbol Hisse Bilgileri</h3>";
        echo "Currency Code: $currencyCode<br>";
        echo "Last Price: $lastPrice";
    }




// $html = '<div jscontroller="NdbN0c" jsaction="oFr1Ad:uxt3if;" jsname="AS5Pxb" data-mid="/g/11l5tcz28_" data-entity-type="0" data-exchange="IST" data-currency-code="TRY" data-last-price="160.7" data-last-normal-market-timestamp="1700838600" data-tz-offset="10800000"><div class="rPF6Lc" jsname="OYCkv"><div class="ln0Gqe"><div jsname="LXPcOd" class=""><div class="AHmHk"><span class=""><div jsname="ip75Cb" class="kf1m0"><div class="YMlKec fxKbKc">₺160,70</div></div></span></div></div><div jsname="CGyduf" class=""><div class="enJeMd"><span jsname="Fe7oBc" class="NydbP VOXKNe tnNmPe" data-disable-percent-toggle="true" data-multiplier-for-price-change="1" aria-label="%0,37 oranında azaldı"><div jsname="m6NnIb" class="zWwE1"><div class="JwB6zf" style="font-size: 16px;"><span class="V53LMb" aria-hidden="true"><svg focusable="false" width="16" height="16" viewBox="0 0 24 24" class=" NMm5M"><path d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"></path></svg></span>%0,37</div></div></span><span class="P2Luy Ebnabc ZYVHBb">-0,60 Bugün</span></div></div></div></div><div class="ygUjEc" jsname="Vebqub">24 Kas, 18:19:01 UTC+3 · TRY · IST · <a href="https://www.google.com/intl/tr_TR/googlefinance/disclaimer/"><span class="koPoYd">Sorumluluk Reddi Beyanı</span></a></div></div>';

// // SVG ve PATH etiketlerini temizleme
// $html = preg_replace('/<svg\b[^>]*>.*?<\/svg>/s', '', $html);
// $html = preg_replace('/<path\b[^>]*>.*?<\/path>/s', '', $html);

// $dom = new DOMDocument;
// $dom->loadHTML($html);

// // XPath nesnesini oluştur
// $xpath = new DOMXPath($dom);

// // data-currency-code ve data-last-price değerlerini al
// $lastPrice = $xpath->query('//div[@data-last-price]')->item(0)->getAttribute('data-last-price');

// // İstenilen veriyi ekrana yazdır
// echo "Last Price: $lastPrice";
