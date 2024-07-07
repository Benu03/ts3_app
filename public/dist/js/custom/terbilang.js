function numberToWords(number) {

    const units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
    const teens = ['', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'];
    const tens = ['', 'sepuluh', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh', 'delapan puluh', 'sembilan puluh'];
    const thousands = ['', 'ribu', 'juta', 'miliar', 'triliun'];

    // Fungsi rekursif untuk mengonversi tiga digit pertama
    function convertThreeDigits(number) {
        let word = '';

        // Mengonversi ratusan
        if (number >= 100) {
            word += units[Math.floor(number / 100)] + ' ratus ';
            number %= 100;
        }

        // Mengonversi puluhan dan satuan
        if (number >= 20) {
            word += tens[Math.floor(number / 10)] + ' ';
            number %= 10;
        } else if (number >= 10) {
            word += teens[number - 10] + ' ';
            number = 0;
        }

        // Mengonversi satuan
        if (number > 0) {
            word += units[number] + ' ';
        }

        return word;
    }

    let word = '';
    let index = 0;

    // Memproses angka dalam kelompok tiga digit
    do {
        const threeDigits = number % 1000;
        if (threeDigits !== 0) {
            word = convertThreeDigits(threeDigits) + thousands[index] + ' ' + word;
        }
        index++;
        number = Math.floor(number / 1000);
    } while (number > 0);

    return word.trim();
}
