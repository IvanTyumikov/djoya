<?php
Yii::import('application.modules.mail.MailModule');

/**
 * Форма заказать звонок
 */
class CallbackFormModal extends CFormModel
{
    public $name;
    public $phone;
    public $email;
    public $body;
    public $verify;
    public $verifyCode;
    public $title;

    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['email', 'email'],
            ['verify, body, title', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('MailModule.mail', 'Ваше имя'),
            'phone'  => Yii::t('MailModule.mail', 'Ваш телефон'),
            'email'  => Yii::t('MailModule.mail', 'Почта'),
            'body'   => Yii::t('MailModule.mail', 'Сообщение'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
            'title' => Yii::t('MailModule.mail', 'Заголовок формы'),
        ];
    }

    public function beforeValidate(){
       /* if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', Yii::t('MailModule.mail', 'Пройдите проверку reCAPTCHA..'));
        } else {
            // $ip = CHttpRequest::getUserHostAddress();
            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],
                // 'remoteip' => $ip,
            ];

            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $response = CJSON::decode($response);
            if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                $this->addError('verifyCode', implode(', ', $response['error-codes']));
            }
        }*/
        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if (empty($this->getErrors())) {

            Yii::import('application.modules.feedback.FeedbackModule');

            $data = [
              'name' => $this->name,
              'email' => $this->email,
              'phone' => $this->phone,
            ];

            // $this->sendBitrixLead($data);

            $feedback = new FeedBack;
            $feedback->name = $this->name;
            $feedback->email = $this->email;
            $feedback->phone = $this->phone;
            $feedback->theme = 'Заказ звонка';

            $feedback->save();

//            if (Yii::app()->hasModule('amocrm')){
//                $amocrm = new Amocrm;
//                $amocrm->addLead([
//                    'phone' => $this->phone,
//                    'name' => $this->name
//                ]);
//            }

//            foreach ($this->getFacebookLeads() as $facebookLead) {
//                $amocrm = new Amocrm;
//                $amocrm->addLead($facebookLead);
//            }
            
            Yii::app()->mailMessage->raiseMailEvent('callback-form-modal', $this->getAttributes());
        }
        return parent::afterValidate();
    }

    public function getFacebookLeads(){
        return [
            [
                'phone' => '+79892391986',
                'name' => 'Юлия Полякова'
            ],
            [
                'phone' => '+79181219137',
                'name' => 'МАНИКЮР КРАСНОДАР'
            ],
            [
                'phone' => '+79308006733',
                'name' => 'Мария Кошелева'
            ],
            [
                'phone' => '+79098134150',
                'name' => 'злобина Ирина'
            ],
            [
                'phone' => '+79667666649',
                'name' => 'Нелли Лагзян'
            ],
            [
                'phone' => '+79312359207',
                'name' => 'Евгения Абрамова'
            ],
            [
                'phone' => '+79237614940',
                'name' => 'Beayty Salon Lidia'
            ],
            [
                'phone' => '+79001283982',
                'name' => 'сертифицированный  Nail мастер Неля'
            ],
            [
                'phone' => '+79209550617',
                'name' => 'Анна Волкова'
            ],
            [
                'phone' => '+79152171022',
                'name' => 'Елена Герман master/trainer'
            ],
            [
                'phone' => '+79776653475',
                'name' => 'Алёна Владимировна'
            ],
            [
                'phone' => '+79385050222',
                'name' => 'Anaida,  Ногти Геленджик'
            ],
            [
                'phone' => '+79244954854',
                'name' => 'Юлия в'
            ],
            [
                'phone' => '+79638141918',
                'name' => 'САЛОН КРАСОТЫ БЛАГОВЕЩЕНСК'
            ],
            [
                'phone' => '+79025470653',
                'name' => 'Анастасия Кузнецова'
            ],
            [
                'phone' => '+79040834805',
                'name' => 'Александра'
            ],
            [
                'phone' => '+79038950188',
                'name' => 'Золотые ножницы'
            ],
            [
                'phone' => '+79640300081',
                'name' => 'Наращивание Ногтей 💅🏻НАЛЬЧИК'
            ],
            [
                'phone' => '+79381122356',
                'name' => '🇬🇪Goar👑💅🏻'
            ],
            [
                'phone' => '+79105213855',
                'name' => 'Алёна Ступакова'
            ],
            [
                'phone' => '+79852380856',
                'name' => 'Екатерина Лунина'
            ],
            [
                'phone' => '+79049865312',
                'name' => 'Педикюр/ маникюр Екатеринбург'
            ],
            [
                'phone' => '+79692887199',
                'name' => 'СВЕТЛАНА С'
            ],
            [
                'phone' => '+79323212459',
                'name' => 'МУЖСКОЙ ПЕДИКЮР МАНИКЮР ТЮМЕНЬ'
            ],
            [
                'phone' => '+79504730992',
                'name' => 'Наталья Зеленина'
            ],
            [
                'phone' => '+79629151485',
                'name' => 'Подолог СерпуховДьяконова Ирина'
            ],
            [
                'phone' => '+70000000000',
                'name' => 'Elen'
            ],
            [
                'phone' => '+79308890571',
                'name' => 'Nailmaster_ryazan'
            ],
            [
                'phone' => '+79500916199',
                'name' => 'Anastasiya Smorygina'
            ],
            [
                'phone' => '+79114742594',
                'name' => 'Марина Керро'
            ],
            [
                'phone' => '+79822028621',
                'name' => 'МАНИКЮР_ Радужный ХМАО'
            ],
            [
                'phone' => '+79026376520',
                'name' => 'Кирпищикова Светлана'
            ],
            [
                'phone' => '+79125422173',
                'name' => 'МАНИКЮР_ПЕДИКЮР_НАРАЩИВАНИЕ'
            ],
            [
                'phone' => '+79898003700',
                'name' => 'Маникюр Педикюр Армавир'
            ],
            [
                'phone' => '+79530529140',
                'name' => 'МАНИКЮР ЕКБ  АВТОВОКЗАЛ'
            ],
            [
                'phone' => '+79824689737',
                'name' => 'ОБОРУДОВАНИЕ САЛОНОВ КРАСОТЫ'
            ],
            [
                'phone' => '+79649538735',
                'name' => 'МАНИКЮР | ЗАБЕЛЬЕ'
            ],
            [
                'phone' => '+79205924742',
                'name' => '"КРАСОТКА БРОШЬ"'
            ],
            [
                'phone' => '+79877980900',
                'name' => 'МАНИКЮР•ГЕЛЬ ЛАК•ПОДОЛОГ•ОРСК'
            ],
            [
                'phone' => '+79226375389',
                'name' => 'Zlokazov'
            ],
            [
                'phone' => '+79832856073',
                'name' => '89832856073'
            ],
            [
                'phone' => '+79061594606',
                'name' => 'карине'
            ],
            [
                'phone' => '+79525368410',
                'name' => 'василина'
            ],
            [
                'phone' => '+79203226621',
                'name' => 'Хрупкая Мама'
            ],
            [
                'phone' => '+79629878652',
                'name' => 'Наталья Папахомова'
            ],
            [
                'phone' => '+79307140448',
                'name' => 'Анжелика Денисова'
            ],
            [
                'phone' => '+79524362871',
                'name' => 'Александра Романенко'
            ],
            [
                'phone' => '+79236061136',
                'name' => 'Якупович Татьяна'
            ],
            [
                'phone' => '+79064655196',
                'name' => 'МАНИКЮР•ПЕДИКЮР•ЖЕЛЕЗНОВОДСК'
            ],
            [
                'phone' => '+79009177673',
                'name' => 'Nadezhda Volova'
            ],
            [
                'phone' => '+79118660899',
                'name' => 'Юлия Майстрова'
            ],
            [
                'phone' => '+79000857031',
                'name' => 'Julia'
            ],
            [
                'phone' => '+79004813580',
                'name' => 'Emilia'
            ],
            [
                'phone' => '+79043223471',
                'name' => 'Маникюр и педикюр Омск'
            ],
            [
                'phone' => '+79892401840',
                'name' => 'Мария'
            ],
            [
                'phone' => '+79854588848',
                'name' => 'МАНИКЮР ЩЕЛКОВО'
            ],
            [
                'phone' => '+79186716208',
                'name' => 'МАНИКЮР. ПЕДИКЮР.'
            ],
            [
                'phone' => '+79508260878',
                'name' => 'ЭТУАЛЬ • SPA • ВОТКИНСК'
            ],
            [
                'phone' => '+79121431439',
                'name' => 'Наталья Лебедева'
            ],
            [
                'phone' => '+79069690459',
                'name' => 'Кристина'
            ],
            [
                'phone' => '+79628244517',
                'name' => 'Евгения Улыбина'
            ],
            [
                'phone' => '+79503213458',
                'name' => 'Анна собко'
            ],
            [
                'phone' => '+79876051911',
                'name' => 'Шахзода'
            ],
            [
                'phone' => '+79200324656',
                'name' => 'Шимина Татьяна/ NRG Н.Новгород'
            ],
            [
                'phone' => '+79233538189',
                'name' => 'МАНИКЮР • БРОВИ • КРАСНОЯРСК'
            ],
            [
                'phone' => '+79247707229',
                'name' => 'Nadezhda  Bukaseeva'
            ],
            [
                'phone' => '+79224739149',
                'name' => 'Svetik'
            ],
            [
                'phone' => '+79237214146',
                'name' => 'Елена'
            ],
            [
                'phone' => '+79539512692',
                'name' => 'Ирина Комнова'
            ],
            [
                'phone' => '+79526613230',
                'name' => 'Даша Константинова'
            ],
            [
                'phone' => '+79149886728',
                'name' => 'ШУГАРИНГ•ДЕПИЛЯЦИЯ•Улан-Удэ'
            ],
            [
                'phone' => '+79600343490',
                'name' => '⚜️Студия Красоты SonMari⚜️'
            ],
            [
                'phone' => '+79044189172',
                'name' => 'только 100% предоплата'
            ],
            [
                'phone' => '+79806715506',
                'name' => 'Natalia'
            ],
            [
                'phone' => '+79516166999',
                'name' => 'КУРСЫ ПО МАНИКЮРУ'
            ],
            [
                'phone' => '+79518653103',
                'name' => 'Маникюр Педикюр Калач'
            ],
            [
                'phone' => '+79824553509',
                'name' => 'Женечка'
            ],
            [
                'phone' => '+79515464344',
                'name' => 'Liana_kov_nails_2020'
            ],
            [
                'phone' => '+79537252155',
                'name' => 'МАНИКЮР / SMM / КУРСЫ'
            ],
            [
                'phone' => '+79637155606',
                'name' => 'Жанна  Серпухов'
            ],
            [
                'phone' => '+79041497869',
                'name' => 'Karina_Valtusova'
            ],
            [
                'phone' => '+79636022000',
                'name' => 'Tanya Samborskaya'
            ],
            [
                'phone' => '+79144804846',
                'name' => 'Анастасия Белякова'
            ],
            [
                'phone' => '+79186206225',
                'name' => 'марина токарева'
            ],
            [
                'phone' => '+79505229376',
                'name' => 'ЮЛЕНЬКА(BEAUTI-SERVICE)))'
            ],
            [
                'phone' => '+79260358186',
                'name' => '🌸Надя🌸'
            ],
            [
                'phone' => '+79281421556',
                'name' => 'Анастасия Бобырева'
            ],
            [
                'phone' => '+79996483950',
                'name' => 'Анюта'
            ],
            [
                'phone' => '+79610905779',
                'name' => 'Шугаринг Ногти Волгоград'
            ],
            [
                'phone' => '+79064055302',
                'name' => 'Яна Мажникова'
            ],
            [
                'phone' => '+79148303318',
                'name' => 'Анна Корнакова'
            ],
            [
                'phone' => '+79242232602',
                'name' => 'ALENA_by_ beautyful nails_'
            ],
            [
                'phone' => '+79026689104',
                'name' => 'Alina Robertovna👑'
            ],
            [
                'phone' => '+79873229469',
                'name' => 'Вячеслав Ващенко'
            ],
            [
                'phone' => '+79086505970',
                'name' => 'Маникюр Ангарск ногти'
            ],
            [
                'phone' => '+79537040362',
                'name' => 'Nastya Reshetova'
            ],
            [
                'phone' => '+79619553038',
                'name' => 'ЛЮДМИЛА ЧЕПИК'
            ],
            [
                'phone' => '+79227305912',
                'name' => 'Катерина Артемова'
            ],
            [
                'phone' => '+79181421036',
                'name' => 'МАНИКЮР ПЕДИКЮР  ТУАПСЕ НЕБУГ'
            ],
            [
                'phone' => '+79241132691',
                'name' => 'Светлана маникюр Бикин'
            ],
            [
                'phone' => '+79033535005',
                'name' => 'ИЛШАТ ГУБАЙДУЛЛИН | БИЗНЕС'
            ],
            [
                'phone' => '+79633229323',
                'name' => 'Татьяна Замай +79633229323'
            ],
            [
                'phone' => '+79835764865',
                'name' => 'Моя ягодка🍒👼рядом💕'
            ],
            [
                'phone' => '+79376961443',
                'name' => 'natalahrameeva'
            ],
            [
                'phone' => '+79064145464',
                'name' => 'Антонова Наталья'
            ],
            [
                'phone' => '+79889177951',
                'name' => 'nogty_ru'
            ],
            [
                'phone' => '+79638542648',
                'name' => 'МАНИКЮР НОВОУРАЛЬСК'
            ],
            [
                'phone' => '+79036076996',
                'name' => 'ira.gogleva.79'
            ],
            [
                'phone' => '+79371685198',
                'name' => 'МАНИКЮР ОКТЯБРЬСКИЙ РБ'
            ],
            [
                'phone' => '+79228841866',
                'name' => 'оксана балабанова'
            ],
            [
                'phone' => '+79613326668',
                'name' => 'Виктория Ятчук'
            ],
            [
                'phone' => '+79841978088',
                'name' => 'НОГТИ. МАНИКЮР. ВЛАДИВОСТОК'
            ],
            [
                'phone' => '+79603057354',
                'name' => 'куратор "Последнего вагона"'
            ],
            [
                'phone' => '+79166884962',
                'name' => 'Гель-лак•Коломна•ногти•Маникюр'
            ],
            [
                'phone' => '+79890908030',
                'name' => 'САЛОН КРАСОТЫ КРАСНОДАР'
            ],
            [
                'phone' => '+79179127589',
                'name' => 'КУРСЫ МАНИКЮРА|ПЕДИКЮРА|НК'
            ],
            [
                'phone' => '+79276178877',
                'name' => 'Черакшева Ольга'
            ],
            [
                'phone' => '+79068147733',
                'name' => 'Александра🌈'
            ],
            [
                'phone' => '+79523430113',
                'name' => 'Наталья Массаж, маникюр'
            ],
            [
                'phone' => '+79517980338',
                'name' => 'Ольга Семенова'
            ],
            [
                'phone' => '+79963480225',
                'name' => 'nargiza abdikalikova'
            ],

            [
                'phone' => '+79644006710',
                'name' => 'Надежда'
            ],
            [
                'phone' => '+79194894524',
                'name' => 'Лена'
            ],
            [
                'phone' => '+79890908030',
                'name' => 'САЛОН КРАСОТЫ КРАСНОДАР'
            ],
            [
                'phone' => '+79619852259',
                'name' => 'Ксения Микулянец'
            ],
            [
                'phone' => '+79189801888',
                'name' => 'Smart_pedikyur_armavir'
            ],
            [
                'phone' => '+79041322028',
                'name' => 'Елена Ласточкина'
            ],
            [
                'phone' => '+79187068191',
                'name' => 'Марина Царукаева 89187068191'
            ],
            [
                'phone' => '+79053886150',
                'name' => 'Студия красоты Iva Fashion'
            ],
            [
                'phone' => '+79124544188',
                'name' => 'alena'
            ],
            [
                'phone' => '+79098137323',
                'name' => '_katerina_'
            ],
            [
                'phone' => '+79261461826',
                'name' => 'Татьяна Авдеенко'
            ],
            [
                'phone' => '+79123189161',
                'name' => 'Дмитрий Лукьянов'
            ],
            [
                'phone' => '+79174269722',
                'name' => 'Ирина Степанова'
            ],
            [
                'phone' => '+79143757600',
                'name' => 'Юлианна Чувашёва'
            ],
            [
                'phone' => '+79280101424',
                'name' => 'Маникюр Педикюр Ставрополь'
            ],
            [
                'phone' => '+79126329723',
                'name' => 'НОГТЕВАЯ МАСТЕРСКАЯ'
            ],
            [
                'phone' => '+79514605602',
                'name' => 'Светлана Светланова'
            ],
            [
                'phone' => '+79148892768',
                'name' => 'Елена Казанцева'
            ],
            [
                'phone' => '+79172730837',
                'name' => 'Татьяна'
            ],
            [
                'phone' => '+79644483528',
                'name' => 'Елена Вишневская'
            ],

            [
                'phone' => '+79181910467',
                'name' => 'Симонян Кира'
            ],
            [
                'phone' => '+79119306499',
                'name' => 'Ольга Тарасенкова'
            ],
            [
                'phone' => '+79144018185',
                'name' => 'Natali Kile'
            ],
            [
                'phone' => '+79875232898',
                'name' => 'ВАШ СТИЛЬ.МАНИКЮР. ПЕНЗА'
            ],
            [
                'phone' => '+79084662649',
                'name' => 'Elen'
            ],
            [
                'phone' => '+79624420880',
                'name' => 'Клевер Бьюти Коворкинг'
            ],
            [
                'phone' => '+79085789858',
                'name' => 'КУРСЫ МАНИКЮР Челябинск'
            ],
            [
                'phone' => '+79611660959',
                'name' => 'ПЕДИКЮР•МАНИКЮР•КОСМЕТОЛОГИЯ'
            ],
            [
                'phone' => '+79835764865',
                'name' => 'Моя ягодка🍒👼рядом💕'
            ],
            [
                'phone' => '+79056661866',
                'name' => 'МАНИКЮР НН АЛЕКСЕЕВСКАЯ 24'
            ],
            [
                'phone' => '+79266715677',
                'name' => 'Светлана'
            ],
            [
                'phone' => '+79271655832',
                'name' => 'Маникюр Мокроус'
            ],
            [
                'phone' => '+79990715591',
                'name' => 'Мария Шурыгина'
            ],
            [
                'phone' => '+79963124126',
                'name' => 'Маникюр●Педикюр●Подология●Чита'
            ],
            [
                'phone' => '+79380275510',
                'name' => 'marilyanka'
            ],
            [
                'phone' => '+79397018242',
                'name' => 'Елена Железнова'
            ],
            [
                'phone' => '+79871614404',
                'name' => 'Маникюр|Самара|Педикюр|Самара'
            ],
            [
                'phone' => '+79187087097',
                'name' => 'Педикюр Владикавказ'
            ],
            [
                'phone' => '+79195321432',
                'name' => 'Natali'
            ],
            [
                'phone' => '+79209037794',
                'name' => 'МАНИКЮР/ПЕДИКЮР | ПЕРМАНЕНТ'
            ],
            [
                'phone' => '+79093310714',
                'name' => 'KARINA'
            ],
            [
                'phone' => '+79118660899',
                'name' => 'ОБУЧЕНИЕ / КУРСЫ / ФРИЛАНС'
            ],
            [
                'phone' => '+79184921414',
                'name' => 'Анжела Муратова'
            ],
            [
                'phone' => '+79643545700',
                'name' => 'ПЕДИКЮР • ЖЕЛЕЗНОГОРСК-ИЛИМСК'
            ],
            [
                'phone' => '+79521405535',
                'name' => 'Ксюша'
            ],
            [
                'phone' => '+79177511304',
                'name' => 'Маникюр педикюр Стерлитамак'
            ],
            [
                'phone' => '+79244568707',
                'name' => 'Наталья Товер'
            ],
            [
                'phone' => '+79601157815',
                'name' => 'Наташа Гончарова'
            ],
            [
                'phone' => '+79113612824',
                'name' => 'Елена Зеленухина'
            ],
            [
                'phone' => '+79502177971',
                'name' => 'Елена Миненкова'
            ],
            [
                'phone' => '+79648711303',
                'name' => 'Елена Лебедева'
            ],
            [
                'phone' => '+79273332510',
                'name' => 'Ольга'
            ],
            [
                'phone' => '+79198938390',
                'name' => 'Эля Клейн'
            ],
            [
                'phone' => '+79028607137',
                'name' => 'МАСТЕР МАНИКЮРА ЗЛАТОУСТ'
            ],
            [
                'phone' => '+79118075497',
                'name' => 'Маникюр Мурманск'
            ],
            [
                'phone' => '+79523469364',
                'name' => 'Маникюр Тобольск Наращивание'
            ],
            [
                'phone' => '+79508344649',
                'name' => 'МАНИКЮР НОГТИ ИЖЕВСК'
            ],
            [
                'phone' => '+79224200599',
                'name' => 'ЕLLEN'
            ],
            [
                'phone' => '+79069362901',
                'name' => 'Мария'
            ],
            [
                'phone' => '+79180496792',
                'name' => 'Екатерина'
            ],
            [
                'phone' => '+79138113214',
                'name' => 'Салон Красоты «Феникс»'
            ],
            [
                'phone' => '+79876051911',
                'name' => 'Шахзода Юсупова'
            ],
            [
                'phone' => '+79682853532',
                'name' => '▪️МАСТЕР МАНИКЮРА-КАМЫШИН▪️'
            ],
            [
                'phone' => '+79048731701',
                'name' => 'людмила'
            ],
            [
                'phone' => '+79870383554',
                'name' => 'Студия красоты ДАРЛЕН, Белебей'
            ],
            [
                'phone' => '+79613326668',
                'name' => 'Виктория Ятчук'
            ],
            [
                'phone' => '+79152109708',
                'name' => 'Студия красоты в стиле LOFT'
            ],
            [
                'phone' => '+79609019541',
                'name' => 'Елена Николаева'
            ],
            [
                'phone' => '+79871150181',
                'name' => 'Валентина Самсонова'
            ],
            [
                'phone' => '+79923320324',
                'name' => 'Наталья Трушникова'
            ],
            [
                'phone' => '+79143948939',
                'name' => 'Олеся'
            ],
            [
                'phone' => '+79237504806',
                'name' => 'НОГТИ ОБУЧЕНИЕ КАМЕНЬ-НА-ОБИ'
            ],
            [
                'phone' => '+79679333291',
                'name' => 'салон красоты Земфира.'
            ],
            [
                'phone' => '+79518653103',
                'name' => 'Маникюр Педикюр Калач'
            ],
            [
                'phone' => '+79378380088',
                'name' => 'Алия'
            ],
            [
                'phone' => '+79963790658',
                'name' => 'Anastasia Dubrova'
            ],
            [
                'phone' => '+79637716665',
                'name' => 'Глухая Алла'
            ],
            [
                'phone' => '+79373700134',
                'name' => 'СТУДИЯ КРАСОТЫ ЧЕБОКСАРЫ'
            ],
            [
                'phone' => '+79323212459',
                'name' => 'МУЖСКОЙ ПЕДИКЮР МАНИКЮР ТЮМЕНЬ'
            ],
            [
                'phone' => '+79534244394',
                'name' => 'МАНИКЮР.ПЕДИКЮР.ПЕРМАНЕНТ.ТУЛА'
            ],
            [
                'phone' => '+79284455333',
                'name' => 'Madlena Stefliani-Akhmetshina'
            ],
            [
                'phone' => '+79516057471',
                'name' => 'Виктория'
            ],
            [
                'phone' => '+79833222549',
                'name' => 'СТРИЖКИ МАНИКЮР БРОВИ НСК'
            ],
            [
                'phone' => '+79638542648',
                'name' => 'МАНИКЮР НОВОУРАЛЬСК'
            ],
            [
                'phone' => '+79511775606',
                'name' => 'Маникюр/Педикюр Полысаево'
            ],
            [
                'phone' => '+79246141850',
                'name' => 'PROFNAILAPPARAT'
            ],
            [
                'phone' => '+79612670489',
                'name' => 'Tatjana_Trudova'
            ],
            [
                'phone' => '+79193608228',
                'name' => 'Маникюр/Педикюр Кам-Уральский'
            ],
            [
                'phone' => '+79049649055',
                'name' => 'Гала Евстюхина'
            ],
            [
                'phone' => '+79227305912',
                'name' => 'Катерина Артемова'
            ],
            [
                'phone' => '+79824506077',
                'name' => 'Маникюр✦Гель-лак📍г. Чайковский'
            ],
            [
                'phone' => '+79608083549',
                'name' => 'Маникюр  Педикюр  Брови Самара'
            ],
            [
                'phone' => '+79854275252',
                'name' => 'Таня'
            ],
            [
                'phone' => '+79180472663',
                'name' => 'Ani'
            ],
            [
                'phone' => '+79159938977',
                'name' => 'Natalia  Sedova'
            ],
            [
                'phone' => '+79043686661',
                'name' => 'МАНИКЮР-ПЕДИКЮР-КУРСЫ-СМОЛЕНСК'
            ],
            [
                'phone' => '+79963480225',
                'name' => 'nargiza abdikalikova'
            ],
            [
                'phone' => '+79873229469',
                'name' => 'Вячеслав Ващенко'
            ],
            [
                'phone' => '+79280460277',
                'name' => 'Хадижат Маммаева'
            ],
            [
                'phone' => '+79997896913',
                'name' => 'Арус'
            ],
            [
                'phone' => '+79281010153',
                'name' => 'Клиника Дентэстетик'
            ],
            [
                'phone' => '+79171564454',
                'name' => 'Евгения'
            ],
            [
                'phone' => '+79537758694',
                'name' => 'Людмила Третьякова'
            ],
            [
                'phone' => '+79106903700',
                'name' => 'Анна Зубынина'
            ],
            [
                'phone' => '+79114626158',
                'name' => 'Ольга Делия'
            ],

        ];
    }

    public function sendBitrixLead( $data ) {
        $idUser = 7;
        $codeWebhooks = 'k4osow0mylcd9scm';
        $queryUrl = 'https://b24-3rvxxd.bitrix24.ru/rest/'.$idUser.'/'.$codeWebhooks.'/crm.lead.add.json';

        $queryData = http_build_query(array(
            'fields' => array(
                'TITLE' => 'Сайт - Заявка с модальной формы',
                'NAME' => $data['name'],
                'LAST_NAME' => '',
                'UF_CRM_1646653244762' => '',  // город
                'UF_CRM_1646656993208' => '',  // расчетный счет
                'UF_CRM_1646657009187' => '',  // инн
                'COMPANY_TITLE' => '',  // название компании
                'PHONE' => [
                    "n0" => [
                        "VALUE" => $data['phone'],
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'EMAIL' => [
                    "n0" => [
                        "VALUE" => $data['email'],
                        "VALUE_TYPE" => "WORK",
                    ]
                ],
                'ASSIGNED_BY_ID' => 835,
                'SOURCE_ID' => 'UC_TJ8O6Z',
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ));
        
        if($queryData !== '') {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $queryUrl,
                CURLOPT_POSTFIELDS => $queryData,
            ));

            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result, 1);

            if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
        }
    }
}
?>