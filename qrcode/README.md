# [Back up to OSHI](../)

![](../qrcodes/qrcode-qrcode.png)

![](../images/qrcode-table.png)

# [OSHI QR Code Set](https://github.com/LafeLabs/OSHI/tree/main/qrcode)

The QR Code set exists to replicate a set of elements of some [Open Source Hardware Instrument(OSHI)](../).  The [qrcode.js](https://github.com/davidshimjs/qrcodejs) [JavaScript](../javascript/) library is used to generate a QR code for each element of the OSHI, which are then all stored in the folder "qrcodes/", each with a name [element name]-qrcode.png.  A table is generated which has each QR code and the name of the element, so they can all be printed out, cut up, and attached to physical media to make a physical representation of the set. 

Replicate this set on a local web server.

To replicate this set, you can use the script at the following replicator address:

```
https://raw.githubusercontent.com/LafeLabs/OSHI/main/php/replicator.txt
```

 - [qrcode.js](https://github.com/davidshimjs/qrcodejs)
 - [webeditor.html](webeditor.html)
 - [qrcode table](qrcode-table.html)
 - [qr code table generator](qrcode-table-generator.html)


Include this code in the "head" element at the top of an html file to call the qrcode javascript library:

```
   <script src = "https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
```

Then to make a QR code, create a div element called "qrcode" copy this code into the javascript:

```
codesquaresize = 170;
globalurl = window.location.href;
qrcode = new QRCode(document.getElementById("qrcode"), {
	text: globalurl,
	width: codesquaresize,
	height: codesquaresize,
	colorDark : "#000000",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H
});
```

to make a QR code of size codesquare and pointing to the url in the browser bar.
