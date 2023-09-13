<!DOCTYPE html>
<html>
<head>
    <title>Caesar Cipher Encryption/Decryption</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Caesar Cipher Encryption/Decryption</h1>
    <?php
    // Fungsi untuk melakukan enkripsi menggunakan Caesar Cipher dengan pergeseran 35
    function caesar_encrypt($plaintext) {
        $shift = 35; // Tetapkan shift ke 35
        $ciphertext = "";

        // Loop melalui setiap karakter dalam plaintext
        for ($i = 0; $i < strlen($plaintext); $i++) {
            $char = $plaintext[$i];

            // Pastikan hanya karakter alfabet yang dienkripsi
            if (ctype_alpha($char)) {
                $isUpperCase = ctype_upper($char);
                $char = strtolower($char);
                $charCode = ord($char);

                // Hitung karakter yang telah digeser
                $shiftedChar = chr((($charCode - ord('a') + $shift) % 26) + ord('a'));

                if ($isUpperCase) {
                    $shiftedChar = strtoupper($shiftedChar);
                }

                $ciphertext .= $shiftedChar;
            } else {
                // Biarkan karakter selain alfabet tetap seperti adanya
                $ciphertext .= $char;
            }
        }

        return $ciphertext;
    }

    // Fungsi untuk melakukan dekripsi menggunakan Caesar Cipher dengan pergeseran 35
    function caesar_decrypt($ciphertext) {
        $shift = 35; // Tetapkan shift ke 35
        $plaintext = "";

        // Loop melalui setiap karakter dalam ciphertext
        for ($i = 0; $i < strlen($ciphertext); $i++) {
            $char = $ciphertext[$i];

            // Pastikan hanya karakter alfabet yang didekripsi
            if (ctype_alpha($char)) {
                $isUpperCase = ctype_upper($char);
                $char = strtolower($char);
                $charCode = ord($char);

                // Hitung karakter yang telah digeser untuk dekripsi
                $shiftedChar = chr(((($charCode - ord('a') - $shift) + 26) % 26) + ord('a'));

                if ($isUpperCase) {
                    $shiftedChar = strtoupper($shiftedChar);
                }

                $plaintext .= $shiftedChar;
            } else {
                // Biarkan karakter selain alfabet tetap seperti adanya
                $plaintext .= $char;
            }
        }

        return $plaintext;
    }

    // Form untuk menginputkan teks
    echo '<form method="post" action="">';
    echo '<label for="text">Plaintext:</label>';
    echo '<textarea id="text" name="text" rows="4" cols="50">' . (isset($_POST['text']) ? $_POST['text'] : '') . '</textarea><br>';
    echo '<input type="submit" name="encrypt" value="Encrypt">';
    echo '<input type="submit" name="decrypt" value="Decrypt">';
    echo '</form>';

    // Proses enkripsi dan dekripsi
    if (isset($_POST['encrypt'])) {
        $plaintext = $_POST['text'];
        $ciphertext = caesar_encrypt($plaintext);
        echo '<label>Ciphertext:</label>';
        echo '<textarea rows="4" cols="50">' . $ciphertext . '</textarea>';
    } elseif (isset($_POST['decrypt'])) {
        $ciphertext = $_POST['text'];
        $plaintext = caesar_decrypt($ciphertext);
        echo '<label>Decrypted Text:</label>';
        echo '<textarea rows="4" cols="50">' . $plaintext . '</textarea>';
    }
    ?>
</body>
</html>
