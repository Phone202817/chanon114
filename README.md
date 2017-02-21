# True Wallet API Wrapper

True Wallet API PHP wrapper.

## Overview

PHP script using curl to get transaction data from True Wallet account.

## Usage

Include our class and login with your True Wallet account.
```
include_once('manager/TrueWallet.php');
$wallet = new TrueWallet();
$wallet->login(username,password);
```
See all functions down below, full example can be found in [example.php](https://github.com/popiazaza/truewallet-api-wrapper/blob/master/example.php)

## Functions

### [function login(username,password)](https://github.com/popiazaza/truewallet-api-wrapper/blob/a18f800230301d229458a5937bb3fcd44629ed39/manager/TrueWallet.php#L14-L19)

Login into True Wallet account with given username & password.

return (string)login page data or (boolean)false if failed to login.

### [function logout()](https://github.com/popiazaza/truewallet-api-wrapper/blob/a18f800230301d229458a5937bb3fcd44629ed39/manager/TrueWallet.php#L21-L24)

Logout from previous True Wallet account.

return (string)logout page data.

### [function get_profile()](https://github.com/popiazaza/truewallet-api-wrapper/blob/a18f800230301d229458a5937bb3fcd44629ed39/manager/TrueWallet.php#L26-L33)

Get profile from current True Wallet account.

return (array object)user profile or (boolean)false if not login yet.

### [function get_transactions()](https://github.com/popiazaza/truewallet-api-wrapper/blob/a18f800230301d229458a5937bb3fcd44629ed39/manager/TrueWallet.php#L35-L43)

Get 50 lastest transactions from current True Wallet account.

return (array object)50 lastest transactions or (boolean)false if not login yet.

### [function function get_report(reportID)](https://github.com/popiazaza/truewallet-api-wrapper/blob/a18f800230301d229458a5937bb3fcd44629ed39/manager/TrueWallet.php#L45-L53)

Get full report of the transaction from given reportID.

return (array object)full report of the transaction or (boolean)false if not login yet.

## Data Example

- get_profile()

```
stdClass Object
(
    [email] => youremail@domain.com
    [password] => (blank)
    [fullname] => Full Name
    [firstnameEn] => (blank)
    [lastnameEn] => (blank)
    [thaiID] => 1234567890123
    [mobileNumber] => 0812345678
    [balance] => 0
    [imageFileName] => (blank)
    [hasPassword] => 0/1
    [hasPin] => 0/1
    [profileImageStatus] => 0/1
    [profileType] => consumer
    [verificationStatus] => unverified/verified
    [purpose] => (blank)
    [profileAddress] => (blank)
    [profilePartner] => (blank)
    [walletToken] => (blank)
    [tmnId] => tmn.10000000000
    [kycVerifyStatus] => (blank)
    [dateOfBirth] => (blank)
    [title] => (blank)
    [occupation] => (blank)
    [profileAddressList] => Array
        (
        (blank)
        )

)
```

- get_transactions()

```
    [0] => stdClass Object
        (
            [reportID] => 12345678
            [logoURL] => https://s3-ap-southeast-1.amazonaws.com/mobile-resource.tewm/wallet-app/common/icon-transaction/m/images/logo_activity_type/transfer_[text3En].png
            **[text3En] is debtor/7-ELEVEN/ecash/campaign/creditor/etc.**
            [text1Th] => โอนเงิน/เติมเงิน Wallet/ซื้อบัตรเงินสดทรูมันนี่/etc.
            [text1En] => Add Money/Transfer/True Money Cash Card/etc.
            [text2Th] => 31/01/17
            [text2En] => 31/01/17
            [text3Th] => โอนเงินให้
            [text3En] => debtor/7-ELEVEN/ecash/campaign/creditor/etc.
            [text4Th] => +500.00/-1,500.00
            [text4En] => +500.00/-1,500.00
            [text5Th] => (blank)/081-234-5678
            [text5En] => (blank)/081-234-5678
        )
     [1]
      .
      .
      .
```

- get_report()

```
stdClass Object
(
    [amount] => 500/-1500
    [ref1] => 0812345678
    [section4] => stdClass Object
        (
            [column1] => stdClass Object
                (
                    [cell1] => stdClass Object
                        (
                            [titleTh] => วันที่-เวลา
                            [titleEn] => Transaction date
                            [value] => 31/01/17 23:59
                        )

                )

            [column2] => stdClass Object
                (
                    [cell1] => stdClass Object
                        (
                            [titleTh] => เลขที่อ้างอิง
                            [titleEn] => Transaction ID
                            [value] => 1234567890
                        )

                )

        )

    [serviceCode] => creditor
    [section3] => stdClass Object
        (
            [column1] => stdClass Object
                (
                    [cell2] => stdClass Object
                        (
                            [titleTh] => ยอดเงินรวม
                            [titleEn] => total amount
                            [value] => +500.00/-1,500.00
                        )

                    [cell1] => stdClass Object
                        (
                            [titleTh] => จำนวนเงินที่ได้รับ
                            [titleEn] => amount
                            [value] => +500.00/-1,500.00
                        )

                )

            [column2] => stdClass Object
                (
                    [cell1] => stdClass Object
                        (
                            [titleTh] => ค่าธรรมเนียม
                            [titleEn] => total fee
                            [value] => 0.00
                        )

                )

        )

    [personalMessage] => stdClass Object
        (
            [value] => 
        )

    [section2] => stdClass Object
        (
            [column1] => stdClass Object
                (
                    [cell2] => stdClass Object
                        (
                            [titleTh] => ชื่อผู้ส่ง
                            [titleEn] => account owner
                            [value] => Full*** name***
                        )

                    [cell1] => stdClass Object
                        (
                            [titleTh] => หมายเลขผู้ส่ง
                            [titleEn] => account number
                            [value] => 081-234-5678
                        )

                )

            [column2] => stdClass Object
                (
                    [operator] => tmn
                )

        )

    [section1] => stdClass Object
        (
            [titleTh] => รับเงินจาก
            [titleEn] => creditor
        )

    [isFavorited] => no
    [isFavoritable] => no
    [serviceType] => transfer
)
```

## Trobleshooting

- curl: (60) SSL certificate : unable to get local issuer certificate

This error commonly found in local server, read how to fix it on [Stackoverflow](http://stackoverflow.com/a/31830614).

- Other SSL/TLS problem

Check your cURL version and openssl extension. If they're old or not enable yet, please fix it.

- Can't login even enter right username/password

If you failed too many attempt to login, your account might get banned. You have to contact True Wallet support directly for further assistance.

## Milestones

- Add shortcut functions to easier get data.
- Format codes and create a composer package.
- Create full functional system.

## Contributors

### [popiazaza](https://github.com/popiazaza)

Donate via paypal: kingkitb@gmail.com or help us by write few lines of code into this github project!

### [Tkaewkunha](https://github.com/Tkaewkunha)

This code is free to use. If you like it, please consider support me via paypal: tkaewkunha@gmail.com thank you.

## License

True Wallet API Wrapper is 100% free and open-source.

Copyright 2017 popiazaza

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
