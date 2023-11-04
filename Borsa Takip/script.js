let borsaVerileri = [];
let duzenleIndex = null;

window.onload = function () {
    borsaVerileri = JSON.parse(localStorage.getItem("borsaVerileri")) || [];
    guncelleTablolar();
};

function ekle() {
    let hisseAdi = document.getElementById("hisseAdi").value;
    let alisMaliyeti = parseFloat(document.getElementById("alisMaliyeti").value);
    let satisFiyati = parseFloat(document.getElementById("satisFiyati").value);
    let adet = parseInt(document.getElementById("adet").value);
    let karZarar = (satisFiyati - alisMaliyeti) * adet;
    let ay = new Date().toLocaleString('default', { month: 'long' });

    if (duzenleIndex !== null) {
        borsaVerileri[duzenleIndex] = {
            hisseAdi: hisseAdi,
            alisMaliyeti: alisMaliyeti,
            satisFiyati: satisFiyati,
            adet: adet,
            karZarar: karZarar,
            ay: ay
        };
        duzenleIndex = null;
    } else {
        borsaVerileri.push({
            hisseAdi: hisseAdi,
            alisMaliyeti: alisMaliyeti,
            satisFiyati: satisFiyati,
            adet: adet,
            karZarar: karZarar,
            ay: ay
        });
    }

    localStorage.setItem("borsaVerileri", JSON.stringify(borsaVerileri));
    guncelleTablolar();
    document.getElementById("borsaForm").reset();
}

function duzenle(index) {
    duzenleIndex = index;
    let seciliHisse = borsaVerileri[index];
    document.getElementById("hisseAdi").value = seciliHisse.hisseAdi;
    document.getElementById("alisMaliyeti").value = seciliHisse.alisMaliyeti;
    document.getElementById("satisFiyati").value = seciliHisse.satisFiyati;
    document.getElementById("adet").value = seciliHisse.adet;
}

function sil(index) {
    borsaVerileri.splice(index, 1);
    localStorage.setItem("borsaVerileri", JSON.stringify(borsaVerileri));
    guncelleTablolar();
}

function guncelleTablolar() {
    let borsaTablosu = document.getElementById("borsaTablosu");
    let aylikKarZararTablosu = document.getElementById("aylikKarZararTablosu");
    borsaTablosu.innerHTML = "<tr><th>Hisse Adı</th><th>Alış Maliyeti</th><th>Satış Fiyatı</th><th>Adet</th><th>Kar/Zarar</th><th>İşlemler</th></tr>";
    aylikKarZararTablosu.innerHTML = "<tr><th>Ay</th><th>Kar/Zarar</th></tr>";

    let toplamKarZarar = {};

    borsaVerileri.forEach(function (hisse, index) {
        let row = borsaTablosu.insertRow();
        row.innerHTML = `<td>${hisse.hisseAdi}</td><td>${hisse.alisMaliyeti}</td><td>${hisse.satisFiyati}</td><td>${hisse.adet}</td><td>${hisse.karZarar}</td><td><button onclick="duzenle(${index})">Düzenle</button> <button onclick="sil(${index})">Sil</button> <button onclick="detay(${index})">Detay</button></td>`;



        let aylar = aylikKarZararTablosu.getElementsByTagName("tr");
        let bulundu = false;

        for (let i = 1; i < aylar.length; i++) {
            let ayAdi = aylar[i].getElementsByTagName("td")[0].innerText;
            if (ayAdi === hisse.ay) {
                let mevcutKarZarar = parseInt(aylar[i].getElementsByTagName("td")[1].innerText);
                mevcutKarZarar += hisse.karZarar;
                aylar[i].getElementsByTagName("td")[1].innerText = mevcutKarZarar;
                bulundu = true;
                break;
            }
        }

        if (!bulundu) {
            let aylikKarZararRow = aylikKarZararTablosu.insertRow();
            aylikKarZararRow.innerHTML = `<td>${hisse.ay}</td><td>${hisse.karZarar}</td>`;
        }

        if (!toplamKarZarar[hisse.ay]) {
            toplamKarZarar[hisse.ay] = 0;
        }

        toplamKarZarar[hisse.ay] += hisse.karZarar;
    });

    let toplamKarZararRow = aylikKarZararTablosu.insertRow();
    toplamKarZararRow.innerHTML = `<td>Toplam</td><td>${Object.values(toplamKarZarar).reduce((a, b) => a + b, 0)}</td>`;
}

let modal = document.getElementById("myModal");
let span = document.getElementsByClassName("close")[0];

function duzenle(index) {
    // Düzenleme butonuna basıldığında modalı göster
    modal.style.display = "block";

    // Seçili hissenin verilerini modal içine yerleştir
    let seciliHisse = borsaVerileri[index];
    document.getElementById("hisseAdiModal").value = seciliHisse.hisseAdi;
    document.getElementById("alisMaliyetiModal").value = seciliHisse.alisMaliyeti;
    document.getElementById("satisFiyatiModal").value = seciliHisse.satisFiyati;
    document.getElementById("adetModal").value = seciliHisse.adet;

    // Modal üzerindeki kaydet (save) butonuna tıklandığında yapılacak işlem
    window.kaydet = function () {
        // Düzenlenen verileri al
        let hisseAdi = document.getElementById("hisseAdiModal").value;
        let alisMaliyeti = parseFloat(document.getElementById("alisMaliyetiModal").value);
        let satisFiyati = parseFloat(document.getElementById("satisFiyatiModal").value);
        let adet = parseInt(document.getElementById("adetModal").value);
        let karZarar = (satisFiyati - alisMaliyeti) * adet;
        let ay = new Date().toLocaleString('default', { month: 'long' });

        // Düzenleme yapılan veriyi güncelle
        borsaVerileri[index] = {
            hisseAdi: hisseAdi,
            alisMaliyeti: alisMaliyeti,
            satisFiyati: satisFiyati,
            adet: adet,
            karZarar: karZarar,
            ay: ay
        };

        // Local storage ve tabloları güncelle
        localStorage.setItem("borsaVerileri", JSON.stringify(borsaVerileri));
        guncelleTablolar();

        // Modalı gizle
        modal.style.display = "none";
    }
}

// Modalın üstündeki "x" butonuna basıldığında modalı gizle
span.onclick = function () {
    modal.style.display = "none";
}

// Modal dışına tıklandığında modalı gizle
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function detay(index) {
    // Detay butonuna basıldığında modalı göster
    let seciliHisse = borsaVerileri[index];
    let detayIcerik = `<p><strong>Hisse Adı:</strong> ${seciliHisse.hisseAdi}</p>`;
    detayIcerik += `<p><strong>Alış Maliyeti:</strong> ${seciliHisse.alisMaliyeti}</p>`;
    detayIcerik += `<p><strong>Satış Fiyatı:</strong> ${seciliHisse.satisFiyati}</p>`;
    detayIcerik += `<p><strong>Adet:</strong> ${seciliHisse.adet}</p>`;
    detayIcerik += `<p><strong>Kar/Zarar:</strong> ${seciliHisse.karZarar}</p>`;
    detayIcerik += `<p><strong>Ay:</strong> ${seciliHisse.ay}</p>`;

    document.getElementById("detayIcerik").innerHTML = detayIcerik;
    document.getElementById("detayModal").style.display = "block";
}

function kapatDetayModal() {
    document.getElementById("detayModal").style.display = "none";
}