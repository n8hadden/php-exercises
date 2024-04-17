<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Number Converter</title>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5">
        <form action="" method="POST">
            <div class="div-to-align form-group mb-4">
                <label for="input" class="mb-4">Input: </label>
                <input class="w-100" type="text" name="input" id="input">
            </div>
            <div class="div-to-align form-group mb-4">
                <label for="num_type">Number is type:  </label>
                <select name="num_type">
                   <option value="dec">Decimal</option>
                   <option value="hex">Hexadecimal</option>
                   <option value="bin">Binary</option>
                </select>
            </div>
            <div class="div-to-align form-group mb-4">
                <input class="w-100 btn btn-primary" type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>


<?php 

$input = $_POST["input"];
$type = $_POST["num_type"];

if ($type == "dec") {
    $input = (int)$input;
    $bin = decimalToBinary($input);
    $hex = decimalToHex($input);
    echo "<div class='container text-center'>" . "Decimal: " . "$input" . "<br></div>";
    echo "<div class='container text-center'>" . "Hexadecimal: " . "$hex" . "<br></div>";
    echo "<div class='container text-center'>" . "Binary: " . "$bin" . "<br></div>";
} elseif ($type == "hex") {
    $dec = hexToDecimal($input);
    $bin = hexToBinary($input);
    echo "<div class='container text-center'>" . "Decimal: " . "$dec" . "<br></div>";
    echo "<div class='container text-center'>" . "Hexadecimal: " . "$input" . "<br></div>";
    echo "<div class='container text-center'>" . "Binary: " . "$bin" . "<br></div>";
} elseif ($type == "bin") {
    $dec = binaryToDecimal($input);
    $hex = binaryToHex($input);
    echo "<div class='container text-center'>" . "Decimal: " ."$dec" . "<br></div>";
    echo "<div class='container text-center'>" . "Hexadecimal: " . "$hex" . "<br></div>";
    echo "<div class='container text-center'>" . "Binary: " . "$input" . "<br></div>";
}

function binaryToHex($binaryString) {
    $hexString = '';
    $binaryLength = strlen($binaryString);
    // Ensure binary length is divisible by 4
    if ($binaryLength % 4 !== 0) {
        $binaryString = str_pad($binaryString, $binaryLength + (4 - $binaryLength % 4), '0', STR_PAD_LEFT);
    }
    // Convert binary to hexadecimal
    for ($i = 0; $i < $binaryLength; $i += 4) {
        $hexString .= dechex(bindec(substr($binaryString, $i, 4)));
    }
    return $hexString;
}

function hexToBinary($hexString) {
    $binaryString = '';
    $hexLength = strlen($hexString);
    for ($i = 0; $i < $hexLength; $i++) {
        $binaryString .= str_pad(decbin(hexdec($hexString[$i])), 4, '0', STR_PAD_LEFT);
    }
    return $binaryString;
}

function binaryToDecimal($binary) {
    $decimal = 0;
    $length = strlen($binary);
    
    for ($i = 0; $i < $length; $i++) {
        // Multiply the current decimal value by 2 and add the next binary digit
        $decimal = $decimal * 2 + intval($binary[$i]);
    }
    
    return $decimal;
}

function decimalToBinary($decimal) {
    $binary = '';
    while ($decimal > 0) {
        $binary = ($decimal % 2) . $binary;
        $decimal = floor($decimal / 2);
    }
    return $binary;
}

function hexToDecimal($hex) {
    $decimal = 0;
    $length = strlen($hex);
    
    for ($i = 0; $i < $length; $i++) {
        // Convert each hexadecimal digit to its decimal equivalent
        $digit = hexdec($hex[$i]);
        
        // Multiply the current decimal value by 16 and add the hexadecimal digit
        $decimal = $decimal * 16 + $digit;
    }
    
    return $decimal;
}

function decimalToHex($decimal) {
    // Use dechex function to convert decimal to hexadecimal
    $hexadecimal = dechex($decimal);
    return $hexadecimal;
}