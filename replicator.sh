mkdir mynewset
cd mynewset
wget https://raw.githubusercontent.com/LafeLabs/network/main/page/replicator.php
php replicator.php
cd elements
cd ../images
wget https://raw.githubusercontent.com/LafeLabs/network/main/page/images/qrcode-page.png
wget https://raw.githubusercontent.com/LafeLabs/network/main/page/images/qrcode.png
cd ..
wget https://raw.githubusercontent.com/LafeLabs/network/main/page/index.html -O index.html
wget https://raw.githubusercontent.com/LafeLabs/network/main/page/replicator.sh -O replicator.sh
wget https://raw.githubusercontent.com/LafeLabs/network/main/page/README.md -O README.md
cd ..
