# true-wallet-crewler

# เกี่ยวกับ

โค๊ดดึงข้อมูลข้อทางการเงินของบัญชี True Wallet สามารถดึงข้อมูลทางการเงินย้อนหลังของบัญชีทรูวอลเลตได้ รวมไปถึงรายละเอียดเช่น วันที่ เวลา ที่โอน เบอร์โทร ชื่อผู้ทำรายการ รวมไปถึงหมายเลขอ้างอิง (Transaction ID)ซึ่งเป็นหมายเลขประจำรายการนั้นๆและเป็นเลขที่ไม่ซ้ำกับรายการอื่น
ซึ่งเมื่อได้หมายเลขโทรศัพ และ หมายเลขอ้างอิงนี้แล้ว สามารถ นำไปประยุคสร้าง ระบบส่งของให้กับลูกค้าอัตโนมัติผ่านทางอีเมลได้

เช่น ขาย ระหัสเกม ราคา 1500 บาท 
เมื่อลูกค้าโอนเงินเข้ามาในบัญชีคุณ 1500 บาทแล้ว ให้ลูกค้ากดยืนยันการโอน
และให้ลูกค้า กรอกหมายเลขอ้างอิงการโอน และเบอร์โทรศัพท์ที่โอน เพื่อยืนยันการโอนเงิน
จากนั้นคุณก็เขียนโค๊ดให้ส่งระหัส ที่เป็นสินค้าของคุณให้กับลูกค้าได้โดยอัตโนมัติ

# การทำงาน

การทำงานของโค๊ดชุดนี้ จะส่ง Request Login ไปยัง TrueWallet และดึงข้อออกมา โดยใช้ Curl  โดยโค๊ดนี้ไม่มีการเก็บข้อมูลของท่านแต่อย่างใด(ไม่เชื่อก็ลองไล่โค๊ดดูได้ครับแหะๆ)

# วิธีใช้
ที่ index.php จะมีตัวอย่างการใช้งานพร้อมคำอธิบายอยู่ แต่ผมจะอธิบายให้อีกรอบ
แก้ไขตัวแปร username , password ให้ตรงามข้อมูลจริงของท่าน

function login(username,password)

function logout()

function get_profile() 
ดึงข้อมูลส่วนตัว

function get_transactions() 
ดึงข้อมูลรายการเดินบัญชี 50 รายการล่าสุด

function get_report(reportID)
ดึงข้อมูลการโอนอย่างละเอียด โดยใช้ reportID ที่ได้จาก get_transactions()
ซึ่ง จำเป็นจะส่งเป็น reportID ให้กับฟังก์ชั้นนี้ ซึ่งผมที่ได้จาก ฟังก์ชั่นนี้จะละเอียดไปจนถึง วันเวลา ที่โอน ชื่อผู้โอน ข้อความจากผู้โอน รวมไปถึงหมายเลขอ้างอิงด้วย


# ตัวอย่างข้อมูล

get_profile

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

ตัวอย่างข้อมูลที่ได้จาก get_transactions()

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


ตัวอย่างข้อมูลที่ได้จาก get_report()

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

# ทิ้งทาย
โค๊ดนี้ฟรีครับ
ถ้าใช้แล้วถูกใจ แล้วกรุณาอยากสนับสนุนก็สามารถทำได้ที่ paypal : tkaewkunha@gmail.com จะถือเป็นความกรุณาอย่างสูงครับ
