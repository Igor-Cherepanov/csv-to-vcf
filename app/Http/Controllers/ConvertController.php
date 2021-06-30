<?php

namespace App\Http\Controllers;

use App\Models\VCardException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\VCard;
use App\Models\Users\UserMail;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\CSV\Sheet;

class ConvertController extends Controller
{

    public const FIELDS = [
        0 => "Обращение",
        1 => "Имя",
        2 => "Отчество",
        3 => "Фамилия",
        4 => "Суффикс",
        5 => "Организация",
        6 => "Отдел",
        7 => "Должность",
        8 => "Улица (раб. адрес)",
        9 => "Улица 2 (раб. адрес)",
        10 => "Улица 3 (раб. адрес)",
        11 => "Город (раб. адрес)",
        12 => "Область (раб. адрес)",
        13 => "Индекс (раб. адрес)",
        14 => "Страна или регион (раб. адрес)",
        15 => "Улица (дом. адрес)",
        16 => "Улица 2 (дом. адрес)",
        17 => "Улица 3 (дом. адрес)",
        18 => "Город (дом. адрес)",
        19 => "Область (дом. адрес)",
        20 => "Почтовый код (дом.)",
        21 => "Страна или регион (дом. адрес)",
        22 => "Улица (другой адрес)",
        23 => "Улица  2 (другой адрес)",
        24 => "Улица  3 (другой адрес)",
        25 => "Город  (другой адрес)",
        26 => "Область  (другой адрес)",
        27 => "Индекс  (другой адрес)",
        28 => "Страна или регион  (другой адрес)",
        29 => "Телефон помощника",
        30 => "Рабочий факс",
        31 => "Рабочий телефон",
        32 => "Телефон раб. 2",
        33 => "Обратный вызов",
        34 => "Телефон в машине",
        35 => "Основной телефон организации",
        36 => "Домашний факс",
        37 => "Домашний телефон",
        38 => "Телефон дом. 2",
        39 => "ISDN",
        40 => "Телефон переносной",
        41 => "Другой факс",
        42 => "Другой телефон",
        43 => "Пейджер",
        44 => "Основной телефон",
        45 => "Радиотелефон",
        46 => "Телетайп/телефон с титрами",
        47 => "Телекс",
        48 => "Важность",
        49 => "Веб-страница",
        50 => "Годовщина",
        51 => "День рождения",
        52 => "Дети",
        53 => "Заметки",
        54 => "Имя помощника",
        55 => "Инициалы",
        56 => "Категории",
        57 => "Ключевые слова",
        58 => "Код организации",
        59 => "Личный номер",
        60 => "Отложено",
        61 => "Пол",
        62 => "Пользователь 1",
        63 => "Пользователь 2",
        64 => "Пользователь 3",
        65 => "Пользователь 4",
        66 => "Пометка",
        67 => "Почтовый ящик (дом. адрес)",
        68 => "Почтовый ящик (другой адрес)",
        69 => "Почтовый ящик (раб. адрес)",
        70 => "Профессия",
        71 => "Расположение",
        72 => "Расположение комнаты",
        73 => "Расстояние",
        74 => "Руководитель",
        75 => "Сведения о доступности в Интернете",
        76 => "Сервер каталогов",
        77 => "Супруг(а)",
        78 => "Счет",
        79 => "Счета",
        80 => "Хобби",
        81 => "Частное",
        82 => "Адрес эл. почты",
        83 => "Тип эл. почты",
        84 => "Краткое имя эл. почты",
        85 => "Адрес 2 эл. почты",
        86 => "Тип 2 эл. почты",
        87 => "Краткое 2 имя эл. почты",
        88 => "Адрес 3 эл. почты",
        89 => "Тип 3 эл. почты",
        90 => "Краткое 3 имя эл. почты",
        91 => "Язык"
    ];

    public function csvToVcfIndex(Request $request)
    {
        $frd = $request->all();

        return view('csv-to-vcf.index');
    }

    /**
     * @param Request $request
     * @throws VCardException
     */
    public function csvToVcfConvert(Request $request): void
    {
        $frd = $request->all();
        $file = Arr::get($frd, 'file');
        $handle = fopen($file, 'rb');
        $row = 0;
        $result = '';
        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                if ($row > 0) {
                    $vCard = new VCard();

                    $cellPhone = Arr::get($data, 31, '');
                    $workPhone = Arr::get($data, 40, '');
                    $homePhone = Arr::get($data, 37, '');

                    $vCard->addName(
                        Arr::get($data, 3, ''),
                        Arr::get($data, 1, ''),
                        Arr::get($data, 2, '')
                    );

                    $vCard->addCompany(Arr::get($data, 5, ''));
                    $vCard->addJobtitle(Arr::get($data, 6, ''));
                    $vCard->addRole(Arr::get($data, 7, ''));
                    $vCard->addEmail(Arr::get($data, 82, ''));
                    if ($cellPhone !== '') {
                        $vCard->addPhoneNumber($cellPhone, 'CELL');
                    }
                    if ($workPhone !== '') {
                        $vCard->addPhoneNumber($workPhone, 'WORK');
                    }
                    if ($homePhone !== '') {
                        $vCard->addPhoneNumber($homePhone, 'HOME');
                    }
                    $result .= $vCard->getOutput();
                }
                $row++;
            }
            fclose($handle);
        }

        $disc = Storage::disk('desktop');
        $disc->put('OSX/' . 'All' . '.vcf', $result);

        dd('end');
    }

    public function mailsToExcelIndex(Request $request)
    {
        $frd = $request->all();

        return view('emails-to-excel.index');
    }

    protected $addresses;

    /**
     * @param Request $request
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     */
    public function mailsToExcelConvert(Request $request): void
    {
//        $path = Storage::path('C:\Private\backup2.csv');
        $path = 'C:\Users\Eilory\Desktop\convert\export4.csv';
        $reader = ReaderEntityFactory::createReaderFromFile($path);
        $reader->setFieldDelimiter(',');
        $reader->open($path);
//        $reader->setFieldEnclosure('@');
//        $reader->setEncoding('UTF-16LE');
        /** @var Sheet $sheet */
        $headers = [
            0 => "Тема",
            1 => "Текст",
            2 => "От: (имя)",
            3 => "От: (адрес)",
            4 => "От: (тип)",
            5 => "Кому: (имя)",
            6 => "Кому: (адрес)",
            7 => "Кому: (тип)",
            8 => "Копия: (имя)",
            9 => "Копия: (адрес)",
            10 => "Копия: (тип)",
            11 => "СК: (имя)",
            12 => "СК: (адрес)",
            13 => "СК: (тип)",
            14 => "Важность",
            15 => "Категории",
            16 => "Пометка",
            17 => "Расстояние",
            18 => "Счета",
        ];

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $ket => $row) {
                $attributes = array();
                foreach ($row->getCells() as $i => $cell) {
                    $attributes[$i] = $cell->getValue();
                }

                $fromName = $attributes[2];
                $from = $attributes[3];
                $toName = $attributes[5];
                $toAddress = $attributes[6];

                $this->push($from, $fromName);
                $this->push($toAddress, $toName);
            }

        }

        $FH = fopen('C:\Users\Eilory\Desktop\convert\export5.csv', 'wb');

        fprintf($FH, chr(0xEF) . chr(0xBB) . chr(0xBF));

        foreach ($this->addresses as $email => $name) {
            $row = [
                $email,
                $name,
            ];


            fputcsv($FH, $row, ',');
        }
        fclose($FH);




        $path = 'C:\Private\export5.csv';
        $disk = Storage::disk('desktop');
        $content = $disk->get('export5.csv');
        $result = str_replace(['"', "'"], '', $content);
        $disk->put('export5.csv', $result);

    }

    public function push(string $address, string $name)
    {
        $blacklist = [
            'Кому: (адрес)',
            'От: (адрес)',
        ];

        if (!in_array($address, $blacklist)) {
            $addresses = explode(';', $address);
            $names = explode(';', $name);
            foreach ($addresses as $i => $add) {
                if (stripos($add, 'EXCHANGE') === false) {
                    $email = $add;
                    $name = $names[$i];

                    $encoding = mb_detect_encoding($name);
                    $result = preg_match('/\p{Cyrillic}/u', $name);


                    if (false === $result && $encoding === 'UTF-8') {
                        $name = mb_convert_encoding($name, "utf-8", "windows-1251");
                    }

                    if ($encoding !== 'UTF-8') {
                        $this->addresses[$email] = $name;
                        echo $encoding . ' ' . $name . ' ' . $email . PHP_EOL;
                    }


                }
            }


        }

    }

}
